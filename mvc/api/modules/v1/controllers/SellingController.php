<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 11.02.19
 * Time: 15:35
 */

namespace api\modules\v1\controllers;

use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\filters\AccessControl;
class SellingController extends ActiveController
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

//        $behaviors['authenticator'] = [
//            'class' => JwtHttpBearerAuth::class,
//        ];
//
//        $behaviors['access']=[
//            'class'=>AccessControl::class,
//            'only'=>['create','update','view'],
//            'rules'=>[
//                [
//
//
//                'actions'=>['create','update'],
//                'allow'=>true,
//                'roles'=>['@'],
//                ],
//                [
//                    'actions'=>['view'],
//                    'allow'=>true,
//                    'roles'=>['*'],
//                ],
//                ],
//            ];
        return $behaviors;
    }

    public $modelClass = 'common\models\SellingConsultation';

}