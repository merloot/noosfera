<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 11.02.19
 * Time: 15:35
 */

namespace api\modules\v1\controllers;

use backend\models\Competence;
use Yii;
use common\models\SellingConsultation;
use common\models\SellingConsultationSearch;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\data\ActiveDataProvider;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

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
//          $behaviors['verb']=[
//              'class'=> VerbFilter::class,
//              'actions'=>[
//              'delete'=>['post'],
//              ],
//
//              'access' => [
//                  'class' => AccessControl::class,
//                  'only' => ['create','update','delete'],
//                  'rules' => [
//                      [
//                          'actions' => ['create','update','delete'],
//                          'allow' => true,
//                          'roles' => ['?'],
//                      ],
//                  ],
//              ],
//              ];
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
    public $serializer = [
        'class'=>'yii\rest\Serializer',
        'collectionEnvelope'=>'items',
    ];

    public $modelClass = 'common\models\SellingConsultation';

    public function actions() {

        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider() {

        $searchModel = new SellingConsultationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider->query->Andwhere(['sc_type'=>1])->orderBy('sc_date')->all();
    }
}