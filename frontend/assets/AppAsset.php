<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
      'jsignature/src/jSignature.js',
      'jsignature/src/plugins/jSignatureCompressorBase30.js',
      'jsignature/src/plugins/jSignature.CompressorSVG.js',
      'jsignature/src/plugins/jSignature.UndoButton.js',
      'js/ksign.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
