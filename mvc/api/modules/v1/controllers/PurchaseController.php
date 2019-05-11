<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 11.02.19
 * Time: 15:34
 */

namespace api\modules\v1\controllers;

use Yii;
use common\models\PurchaseConsultationSearch;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\web\Response;
use yii\data\Pagination;

class PurchaseController extends ActiveController
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

        return $behaviors;
    }

    public $serializer = [
        'class'=>'yii\rest\Serializer',
        'collectionEnvelope'=>'items',
    ];

    public $modelClass ='common\models\PurchaseConsultation';

    public function actions() {

        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider() {

        $searchModel = new PurchaseConsultationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $pages = new Pagination([
            'totalCount' => $dataProvider
                ->query
                ->count(),
                'pageSize'=>21
        ]);


        return $dataProvider
            ->query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->Andwhere(['pc_type'=>1])
            ->orderBy('pc_date')
            ->all();
    }

}