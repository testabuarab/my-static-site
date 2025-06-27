<?php

namespace mutation\translate\controllers;

use Craft;
use craft\helpers\UrlHelper;
use craft\web\Controller;
use craft\web\UploadedFile;
use mutation\translate\helpers\DbHelper;
use mutation\translate\models\Message;
use mutation\translate\models\SourceMessage;
use mutation\translate\Translate;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class ImportController extends Controller
{
    public function actionIndex()
    {
        $this->requirePermission(Translate::IMPORT_TRANSLATIONS_PERMISSION);

        $categories = Translate::getInstance()->settings->getCategories();
        $categoriesSelect = [];
        foreach ($categories as $category) {
            $categoriesSelect[] = [
                'value' => $category,
                'label' => $category,
            ];
        }

        $settings = Translate::getInstance()->settings;

        $pluginName = $settings->pluginName;
        $templateTitle = Craft::t('translations-admin', 'Import');

        $variables = [];
        $variables['fullPageForm'] = true;
        $variables['title'] = $templateTitle;
        $variables['crumbs'] = [
            [
                'label' => $pluginName,
                'url' => UrlHelper::cpUrl('translations-admin'),
            ],
            [
                'label' => $templateTitle,
                'url' => UrlHelper::cpUrl('translations-admin/import-messages'),
            ],
        ];
        $variables['docTitle'] = "{$pluginName} - {$templateTitle}";
        $variables['selectedSubnavItem'] = 'import';
        $variables['categories'] = $categoriesSelect;

        $this->renderTemplate('translations-admin/import', $variables);
    }

    public function actionImport()
    {
        $this->requirePermission(Translate::IMPORT_TRANSLATIONS_PERMISSION);

        $this->requirePostRequest();

        $category = Craft::$app->request->getRequiredBodyParam('category');

        $csvFile = UploadedFile::getInstanceByName('file');

        $siteLocales = Craft::$app->i18n->getSiteLocales();
        sort($siteLocales);

        if ($csvFile) {
            $tempPath = $csvFile->saveAsTempFile();

            $reader = new Csv();
            $reader->setReadDataOnly(true);

            $spreadsheet = $reader->load($tempPath);
            $rows = $spreadsheet->getActiveSheet()->toArray();
            $headers = $rows[0];
            array_shift($rows);

            $updated = 0;
            $added = 0;

            foreach ($rows as $row) {
                $key = $row[0];

                /* @var SourceMessage $sourceMessage */
                $sourceMessage = SourceMessage::find()
                    ->where(array(DbHelper::caseSensitiveComparisonString('message') => $key, 'category' => $category))
                    ->one();

                if (!$sourceMessage) {
                    $sourceMessage = new SourceMessage();
                    $sourceMessage->category = $category;
                    $sourceMessage->message = $key;
                    $sourceMessage->save();
                }

                $i = 1;
                foreach ($siteLocales as $siteLocale) {
                    $translation = $row[$i];
                    $translation = trim($translation) !== '' ? $translation : null;
                    $i++;

                    /* @var Message $message */
                    $message = Message::find()
                        ->where(array('language' => $siteLocale->id, 'id' => $sourceMessage->id))
                        ->one();

                    if (!$message) {
                        $message = new Message();
                        $message->id = $sourceMessage->id;
                        $message->language = $siteLocale->id;
                        $message->translation = null;
                    }

                    $oldTranslation = $message->translation;

                    if ($message->translation !== $translation) {
                        $message->translation = $translation;
                        if ($message->save()) {
                            if ($oldTranslation === null) {
                                $added++;
                            } else {
                                $updated++;
                            }
                        }
                    }
                }
            }

            Craft::$app->getSession()->setNotice(
                Craft::t(
                    'translations-admin',
                    '{added} translations added. {updated} translations updated.',
                    ['added' => $added, 'updated' => $updated]
                )
            );
        } else {
            Craft::$app->getSession()->setError(
                Craft::t(
                    'translations-admin',
                    'No csv file uploaded.'
                )
            );
        }

        return $this->redirectToPostedUrl();
    }
}
