<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    'js/edr_custom.js',
    'js/jsignature/src/jSignature.js',
    'js/jsignature/src/plugins/jSignatureCompressorBase30.js',
    'js/jsignature/src/plugins/jSignature.CompressorSVG.js',
    'js/jsignature/src/plugins/jSignature.UndoButton.js',
    'js/ksign.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
