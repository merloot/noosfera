<?php

namespace api\modules\v1\controllers;

use yii\data\Pagination;
use common\models\ProfileSearch;
use yii;
use yii\web\Response;
use yii\rest\ActiveController;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\ContentNegotiator;

class ProfileController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['ContentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
            ];
//        $behaviors['authenticator'] = [
//            'class' => JwtHttpBearerAuth::class,
//        ];
        return $behaviors;
    }

    public $serializer = [
        'class'=>'yii\rest\Serializer',
        'collectionEnvelope'=>'items',
    ];

    public $modelClass = 'common\models\Profile';

}