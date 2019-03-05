<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 22.02.19
 * Time: 16:58
 */

namespace api\modules\v1\controllers;

use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;

class TagController extends ActiveController
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['ContentNegotiator']=[
            'class'=> ContentNegotiator::class,
            'formats' =>[
                'application/json' => Response::FORMAT_JSON,
            ]
        ];
//
//        $behaviors ['cors']=[
//            'class'=> Cors::class,
//            'Origin' => ['*'],
//            'Access-Control-Request-Method' => ['GET', 'HEAD', 'OPTIONS','POST'],
//        ];
//        $behaviors['authenticator'] = [
//            'class' => JwtHttpBearerAuth::class,
//            ];

        return $behaviors;
    }

    public $serializer = [
        'class'=>'yii\rest\Serializer',
        'collectionEnvelope'=>'items',
    ];

    public $modelClass = 'common\models\Tags';

}