<?php

namespace api\modules\v1\controllers;


use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use common\models\User;
use common\models\Token;
use yii\filters\Cors;
use sizeg\jwt\JwtHttpBearerAuth;

class LoginController extends Controller
{
    public function behaviors()
    {

        return [
            'corsFilter' => [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => [ 'POST', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                ],
            ],
            'authenticator'=> [
                'class' => JwtHttpBearerAuth::class,
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'index'=>['post', 'options'],
//                ]
//            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => [ 'index'],
//                        'roles' => ['*'],
//                    ],
//                ],
//            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }




}