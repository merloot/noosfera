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
         //   'csrfParam' => '_csrf-api',
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
                'v1/user/<action:user|login>'=>'v1/user/<action>', //Альтернатива работы авторизации
//                '<module:v1>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
// Если брать строку с actions не работает вызов  action/login

                ['class'=>'yii\rest\UrlRule',
                    'controller'=> 'v1/user',

                ],

                ['class'=>'yii\rest\UrlRule',
                    'controller'=>'v1/tag',
                ],

                ['class'=>'yii\rest\UrlRule',
                    'controller'=>'v1/tag_con',

                ],

                ['class'=>'yii\rest\UrlRule',
                    'controller'=> 'v1/profile',
                ],

                ['class'=>'yii\rest\UrlRule',
                    'controller'=>'v1/purchase',
                ],

                ['class'=>'yii\rest\UrlRule',
                    'controller'=>'v1/selling',
                ],

                ['class'=> 'yii\rest\UrlRule',
                    'controller'=>'v1/competence',
                ],

                ['class'=>'yii\rest\UrlRule',
                    'controller'=>'v1/consultation',
                ],

                ['class'=> 'yii\rest\UrlRule',
                    'controller'=>'v1/com',
                ],
            ],
        ],
    ],
    'params' => $params,
];