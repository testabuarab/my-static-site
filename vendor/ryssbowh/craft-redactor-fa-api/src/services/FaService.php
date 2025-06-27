<?php

namespace Ryssbowh\RedactorFa\services;

use Ryssbowh\RedactorFa\RedactorFa;
use Ryssbowh\RedactorFa\assets\bundles\FaAssetBundle;
use Ryssbowh\RedactorFa\assets\bundles\FaConfigAssetBundle;
use Ryssbowh\RedactorFa\exceptions\ScanException;
use craft\base\Component;
use craft\helpers\StringHelper;
use craft\web\View;

class FaService extends Component
{
    const API_URL = 'https://api.fontawesome.com';

    protected $_faVersions;

    /**
     * Registers all FA files on the view
     */
    public function registerFaFiles()
    {
        $this->registerFaJs();
        $this->registerFaCss();
    }

    /**
     * Registers all js FA files on the view
     */
    public function registerFaJs()
    {
        $settings = RedactorFa::$plugin->settings;
        if ($settings->useKit) {
            return \Craft::$app->view->registerJsFile($settings->kitUrl, [
                'position' => View::POS_HEAD
            ]);
        }
    }

    /**
     * Registers all css FA files on the view
     */
    public function registerFaCss()
    {
        $settings = RedactorFa::$plugin->settings;
        if ($settings->useKit) {
            return;
        }
        $path = \Craft::$app->assetManager->publish($settings->faPath);
        \Craft::$app->view->registerCssFile($path[1] . '/css/all.css');
    }

    /**
     * Modify redactor config
     *
     * @param  array  $config
     * @return array
     */
    public function modifyRedactorConfig(array $config): array
    {
        if (!in_array('fontawesome', $config['plugins'] ?? [])) {
            return $config;
        }
        $settings = RedactorFa::$plugin->settings;
        $config['redactorFaApi'] = [
            'mode' => $settings->mode,
            'version' => $settings->faVersion,
            'license' => $settings->faLicense,
            'preventReplaceI' => $settings->preventReplaceI
        ];
        \Craft::$app->view->registerAssetBundle(FaAssetBundle::class);
        $this->registerFaFiles();
        return $config;
    }

    /**
     * Get available FA versions through the API
     * 
     * @return array
     */
    public function getVersions(): array
    {
        if ($this->_faVersions === null) {
            $data = http_build_query(['query' => 'query { releases { version } }']);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::API_URL);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close ($ch);
            $output = json_decode($output, true);
            $versions = array_map(function ($version) {
                return $version['version'];
            }, $output['data']['releases']);
            return array_combine($versions, $versions);
        }
        return $this->_faVersions;
    }
}