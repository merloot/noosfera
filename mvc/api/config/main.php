<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@api/modules/v1',
            'class' => 'api\modules\v1\Module'
        ]
    ],
    'components' => [
        'jwt' => [
            'class' => 'sizeg\jwt\Jwt',
            'key'   => 'secrett1112122212',
        ],
        'request' => [
            'csrfParam' => '_csrf-api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],

        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'enableSession' => false,
        ],
        // 'session' => [
        // this is the name of the session cookie used for login on the frontend
        // 'name' => 'advanced-api',
        // ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
// 'errorHandler' => [
// 'errorAction' => 'site/error',
// ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [

                ['class'=>'yii\rest\UrlRule',
                    'controller'=>'v1/login',
                ],

                ['class'=>'yii\rest\UrlRule',
                    'controller'=> 'v1/user',

                ],

                ['class'=>'yii\rest\UrlRule',
                    'controller'=> 'v1/profile',

                ],

            ],
        ],
    ],
    'params' => $params,
];