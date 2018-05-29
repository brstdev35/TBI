<?php

namespace TBI\Login;

use yii\web\AssetBundle;

/**
 * Module asset bundle
 */
class LoginAsset extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@TBI/Login/web';

    public $css = [
        'css/images.css',
    ];
    public $js = [
        'js/custom.js',
    ];
} 