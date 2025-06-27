<?php

namespace Ryssbowh\RedactorFa\models;

use Craft;
use craft\base\Model;

class Settings extends Model
{
    /**
     * @var string
     */
    public $faPath = '@Ryssbowh/RedactorFa/assets/font-awesome6';

    /**
     * @var boolean
     */
    public $useKit = false;

    /**
     * @var boolean
     */
    public $kitUrl = false;

    /**
     * @var string
     */
    public $faVersion = '6.1.1';

    /**
     * @var string
     */
    public $faLicense = 'free';

    /**
     * Prevent redactor to replace all i tags by em tags
     * @see https://imperavi.com/redactor/docs/settings/clean/#s-replacetags
     */
    public $preventReplaceI = false;

    /**
     * @inheritdoc
     */
    public function defineRules(): array
    {
        return [
            [['faLicense'], 'string'],
            ['kitUrl', 'url'],
            ['faPath', 'validatePath']
        ];
    }

    /**
     * Validate the font awesome path which must contain css/all.css
     */
    public function validatePath()
    {
        if ($this->useKit) {
            return;
        }
        $path = \Craft::getAlias($this->faPath);
        if (!file_exists($path)) {
            $this->addError('faPath', \Craft::t('redactor-fa-api', "This folder doesn't exist"));
        }
        $required = ['css' . DIRECTORY_SEPARATOR . 'all.css'];
        foreach ($required as $file) {
            $fullPath = $path . DIRECTORY_SEPARATOR . $file;
            if (!file_exists($fullPath)) {
                $this->addError('faPath', \Craft::t('redactor-fa-api', "The file $file could not be found in this folder"));
            }
        }
    }

    /**
     * Chosen mode for font awesome, path or kit
     * 
     * @return string
     */
    public function getMode(): string
    {
        return $this->useKit ? 'kit' : 'path';
    }
}
