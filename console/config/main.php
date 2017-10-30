<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
          ],
    ],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'urlManager'=>[
          'class'=>'yii\web\UrlManager',
            //'baseUrl'=>'http://localhost/system/frontend/web/index.php';
          //  'baseUrl'=>'http://localhost/system_edr/frontend/web/index.php',
          //  'scriptUrl'=>'http://localhost/system_edr/frontend/web/index.php',
            'baseUrl'=>'http://techelm2012.firstcomdemolinks.com/system/backend/web/index.php',
             'scriptUrl'=>'http://techelm2012.firstcomdemolinks.com/system/backend/web/index.php',
          //  'baseUrl'=>'http://localhost/system/frontend/web/index.php',
            //'scriptUrl'=>'http://localhost/system/frontend/web/index.php',
        ],


    ],
    'params' => $params,
];
