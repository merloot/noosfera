<?php

namespace api\modules\v1\controllers;

use yii;
use yii\filters\Cors;
use yii\web\Response;
use common\models\User;
use common\models\Profile;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\ContentNegotiator;


class ProfileController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['ContentNegotiator']=[
            'class'=> ContentNegotiator::class,
            'formats' =>[
                'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML,
            ]
        ];

        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
        ];
        return $behaviors;
    }
    public $modelClass = 'common\models\Profile';
}