<?php

namespace TBI\Login;

use yii\web\AssetBundle;

/**
 * Module asset bundle
 */
class LoginAsset extends AssetBundle {

    /**
     * @inheritdoc
     */
    public $sourcePath = '@TBI/Login/web';
    public $css = [
        'css/images.css',
        'css/font-awesome.min.css',
        'css/AdminLTE.min.css',
        'css/jquery.Jcrop.min.css',
    ];
    public $js = [
        'js/custom.js',
        'js/app.min.js',
        'js/jquery.Jcrop.js',
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
    
    public $skin = '_all-skins';

    /**
     * @inheritdoc
     */
    public function init()
    {
        // Append skin color file if specified
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }

            $this->css[] = sprintf('css/skins/%s.min.css', $this->skin);
        }

        parent::init();
    }

}
