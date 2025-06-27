/**
 * CodeEditor Craft CMS
 *
 * Provides a code editor field with Twig & Craft API autocomplete
 *
 * @link      https://nystudio107.com
 * @copyright Copyright (c) 2022 nystudio107
 */

import * as monaco from "monaco-editor/esm/vs/editor/editor.api";
import {editor} from "monaco-editor/esm/vs/editor/editor.api";
import {TabFocus} from 'monaco-editor/esm/vs/editor/browser/config/tabFocus.js';
import {getCompletionItemsFromEndpoint} from './twig-autocomplete';
import {languageIcons} from './language-icons'
import {defaultMonacoOptions} from "./default-monaco-options";
import EditorOption = editor.EditorOption;

/**
 * @author    nystudio107
 * @package   CodeEditor
 * @since     1.0.0
 */

declare global {
  let __webpack_public_path__: string;
  const Craft: Craft;

  interface Window {
    codeEditorBaseAssetsUrl: string;
    makeMonacoEditor: MakeMonacoEditorFn;
    setMonacoEditorLanguage: SetMonacoEditorLanguageFn;
    setMonacoEditorTheme: SetMonacoEditorThemeFn;
    monacoEditorInstances: { [key: string]: monaco.editor.IStandaloneCodeEditor };
  }
}

const MAX_EDITOR_ROWS = 50;

// Set the __webpack_public_path__ dynamically, so we can work inside cpresources's hashed dir name
// https://stackoverflow.com/questions/39879680/example-of-setting-webpack-public-path-at-runtime
if (typeof __webpack_public_path__ === 'undefined' || __webpack_public_path__ === '') {
  __webpack_public_path__ = window.codeEditorBaseAssetsUrl;
}

/**
 * Create a Monaco Editor instance
 *
 * @param {string} elementId - The id of the TextArea or Input element to replace with a Monaco editor
 * @param {string} fieldType - The field's passed in type, used for autocomplete caching
 * @param {monaco.editor.IStandaloneEditorConstructionOptions} monacoOptions - Monaco editor options
 * @param {string} codeEditorOptions - JSON encoded string of arbitrary CodeEditorOptions for the field
 * @param {string} endpointUrl - The controller action endpoint for generating autocomplete items
 */
function makeMonacoEditor(elementId: string, fieldType: string, monacoOptions: string, codeEditorOptions: string, endpointUrl: string): monaco.editor.IStandaloneCodeEditor | undefined {
  const textArea = <HTMLInputElement | null>document.getElementById(elementId);
  const container = document.createElement('div');
  const fieldOptions: CodeEditorOptions = JSON.parse(codeEditorOptions);
  const placeholderId = elementId + '-monaco-editor-placeholder';
  // If we can't find the passed in text area or if there is no parent node, return
  if (textArea === null || textArea.parentNode === null) {
    return;
  }
  // Monaco editor options passed in from the config
  const monacoEditorOptions: monaco.editor.IStandaloneEditorConstructionOptions = JSON.parse(monacoOptions);
  // Set the scrollbar to hidden in defaultMonacoOptions if this is a single-line field
  if ('singleLineEditor' in fieldOptions && fieldOptions.singleLineEditor) {
    defaultMonacoOptions.scrollbar = {
      vertical: 'hidden',
      horizontal: 'auto',
      alwaysConsumeMouseWheel: false,
      handleMouseWheel: false,
    };
  }
  // Create the model with a unique URI so individual instances can be targeted
  const modelUri = monaco.Uri.parse('https://craft-code-editor.com/' + elementId);
  const textModel = monaco.editor.createModel(textArea.value, monacoEditorOptions.language ?? defaultMonacoOptions.language, modelUri);
  defaultMonacoOptions.model = textModel;
  // Set the editor theme here, so we don't re-apply it later
  monacoEditorOptions.theme = getEditorTheme(monacoEditorOptions?.theme);
  // Monaco editor defaults, coalesced together
  const options: monaco.editor.IStandaloneEditorConstructionOptions = {...defaultMonacoOptions, ...monacoEditorOptions}
  // Make a sibling div for the Monaco editor to live in
  container.id = elementId + '-monaco-editor';
  container.classList.add('monaco-editor', 'relative', 'box-content', 'monaco-editor-codefield', 'h-full');
  // Apply any passed in classes to the wrapper div
  const wrapperClass = fieldOptions.wrapperClass ?? '';
  if (wrapperClass !== '') {
    const cl = container.classList;
    const classArray = wrapperClass.trim().split(/\s+/);
    cl.add(...classArray);
  }
  // Create an empty div for the icon
  const displayLanguageIcon = fieldOptions.displayLanguageIcon ?? true;
  if (displayLanguageIcon) {
    const icon = document.createElement('div');
    icon.id = elementId + '-monaco-language-icon';
    container.appendChild(icon);
  }
  // Handle the placeholder text (if any)
  const placeholderText = fieldOptions.placeholderText ?? '';
  if (placeholderText !== '') {
    const placeholder = document.createElement('div');
    placeholder.id = elementId + '-monaco-editor-placeholder';
    placeholder.innerHTML = placeholderText;
    placeholder.classList.add('monaco-placeholder', 'p-2');
    container.appendChild(placeholder);
  }
  textArea.parentNode.insertBefore(container, textArea);
  textArea.style.display = 'none';
  // Create the Monaco editor
  const editor = monaco.editor.create(container, options);
  // Make the monaco editor instances available via the monacoEditorInstances global, since Twig macros can't return a value
  if (typeof window.monacoEditorInstances === 'undefined') {
    window.monacoEditorInstances = {};
  }
  window.monacoEditorInstances[elementId] = editor;
  // When the text is changed in the editor, sync it to the underlying TextArea input
  editor.onDidChangeModelContent(() => {
    textArea.value = editor.getValue();
  });
  // Add the language icon (if any)
  setMonacoEditorLanguage(editor, options.language, elementId);
  // ref: https://github.com/vikyd/vue-monaco-singleline/blob/master/src/monaco-singleline.vue#L150
  if ('singleLineEditor' in fieldOptions && fieldOptions.singleLineEditor) {
    if (textModel !== null) {
      // Remove multiple spaces & tabs
      const text = textModel.getValue();
      textModel.setValue(text.replace(/\s\s+/g, ' '));
      // Handle the Find command
      editor.addCommand(monaco.KeyMod.CtrlCmd | monaco.KeyCode.KeyF, () => {
      });
      // Handle typing the Enter key
      editor.addCommand(monaco.KeyCode.Enter, () => {
      }, '!suggestWidgetVisible');
      // Enable TabFocusMode ref: https://stackoverflow.com/questions/74202202/how-to-programatically-set-tabfocusmode-in-monaco-editor/74598917
      editor.onDidFocusEditorWidget(() => {
        TabFocus.setTabFocusMode(true);
      });
      // Handle Paste
      editor.onDidPaste(() => {
        // multiple rows will be merged to single row
        let newContent = '';
        const lineCount = textModel.getLineCount();
        // remove all line breaks
        for (let i = 0; i < lineCount; i += 1) {
          newContent += textModel.getLineContent(i + 1);
        }
        // Remove multiple spaces & tabs
        newContent = newContent.replace(/\s\s+/g, ' ');
        textModel.setValue(newContent);
        editor.setPosition({column: newContent.length + 1, lineNumber: 1});
      })
    }
  }
  // Get the autocompletion items if the language is Twig
  if (options.language === 'twig') {
    getCompletionItemsFromEndpoint(fieldType, codeEditorOptions, endpointUrl);
  }
  // Custom resizer to always keep the editor full-height, without needing to scroll
  let ignoreEvent = false;
  const updateHeight = () => {
    const width = editor.getLayoutInfo().width;
    const lineHeight = editor.getOption(EditorOption.lineHeight);
    let contentHeight = Math.min(lineHeight * MAX_EDITOR_ROWS, editor.getContentHeight());
    if (textArea instanceof HTMLTextAreaElement) {
      contentHeight = Math.max(textArea.rows * lineHeight, contentHeight)
    }
    //container.style.width = `${width}px`;
    container.style.height = `${contentHeight}px`;
    try {
      ignoreEvent = true;
      editor.layout({width, height: contentHeight});
    } finally {
      ignoreEvent = false;
    }
  };
  editor.onDidContentSizeChange(updateHeight);
  updateHeight();
  // Handle the placeholder
  if (placeholderText !== '') {
    showPlaceholder('#' + placeholderId, editor.getValue());
    editor.onDidBlurEditorWidget(() => {
      showPlaceholder('#' + placeholderId, editor.getValue());
    });
    editor.onDidFocusEditorWidget(() => {
      hidePlaceholder('#' + placeholderId);
    });
  }

  /**
   * Show the placeholder text
   *
   * @param {string} selector - The selector for the placeholder element
   * @param {string} value - The editor field's value (the text)
   */
  function showPlaceholder(selector: string, value: string): void {
    if (value === "") {
      const elem = <HTMLElement | null>document.querySelector(selector);
      if (elem !== null) {
        elem.style.display = "initial";
      }
    }
  }

  /**
   * Hide the placeholder text
   *
   * @param {string} selector - The selector for the placeholder element
   */
  function hidePlaceholder(selector: string): void {
    const elem = <HTMLElement | null>document.querySelector(selector);
    if (elem !== null) {
      elem.style.display = "none";
    }
  }

  return editor;
}

/**
 * Set the language for the Monaco editor instance
 *
 * @param {monaco.editor.IStandaloneCodeEditor} editor - the Monaco editor instance
 * @param {string | undefined} language - the editor language
 * @param {string} elementId - the element id used to create the monaco editor from
 */
function setMonacoEditorLanguage(editor: monaco.editor.IStandaloneCodeEditor, language: string | undefined, elementId: string): void {
  const containerId = elementId + '-monaco-editor';
  const iconId = elementId + '-monaco-language-icon';
  const container = <Element | null>document.querySelector('#' + containerId);
  if (container !== null) {
    if (typeof language !== "undefined") {
      const languageIcon = languageIcons[language] ?? languageIcons['default'] ?? null;
      const icon = document.createElement('div');
      monaco.editor.setModelLanguage(editor.getModel()!, language);
      icon.id = iconId;
      // Only add in the icon if one is available
      if (languageIcon !== null) {
        let message = 'code is supported.';
        if (window.hasOwnProperty('Craft')) {
          message = Craft.t('codeeditor', message);
        }
        const languageTitle = language.charAt(0).toUpperCase() + language.slice(1) + ' ' + message;
        icon.classList.add('monaco-editor-codefield--icon');
        icon.setAttribute('title', languageTitle);
        icon.setAttribute('aria-hidden', 'true');
        icon.innerHTML = languageIcon;
      }
      // Replace the icon div
      const currentIcon = container.querySelector('#' + iconId);
      if (currentIcon) {
        container.replaceChild(icon, currentIcon);
      }
    }
  }
}

/**
 * Return the editor theme to use, accounting for undefined and 'auto' as potential parameters
 *
 * @param {string | undefined} theme - the editor theme
 */
function getEditorTheme(theme: string | undefined): string {
  let editorTheme = theme ?? 'vs';
  if (editorTheme === 'auto') {
    const mediaQueryObj = window.matchMedia('(prefers-color-scheme: dark)');
    editorTheme = mediaQueryObj.matches ? 'vs-dark' : 'vs';
  }

  return editorTheme;
}

/**
 * Set the theme for the Monaco editor instance
 *
 * @param {monaco.editor.IStandaloneCodeEditor} editor - the Monaco editor instance
 * @param {string | undefined} theme - the editor theme
 */
function setMonacoEditorTheme(editor: monaco.editor.IStandaloneCodeEditor, theme: string | undefined): void {
  const editorTheme = getEditorTheme(theme);
  // @ts-ignore
  const currentTheme = editor._themeService?._theme?.themeName ?? null;
  if (currentTheme !== editorTheme) {
    editor.updateOptions({theme: editorTheme});
  }
}

// Make the functions globally available
window.makeMonacoEditor = makeMonacoEditor;
window.setMonacoEditorLanguage = setMonacoEditorLanguage;
window.setMonacoEditorTheme = setMonacoEditorTheme;

export {makeMonacoEditor, setMonacoEditorLanguage, setMonacoEditorTheme};
