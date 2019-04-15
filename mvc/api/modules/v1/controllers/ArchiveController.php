<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 02.04.19
 * Time: 10:05
 */

namespace api\modules\v1\controllers;

use common\models\ArchiveSearch;
use yii\data\Pagination;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;

class ArchiveController extends ActiveController
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

    public $modelClass = 'common\models\Archive';
    public function actions() {

        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider() {

        $searchModel = new ArchiveSearch();

        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

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
            ->Andwhere(['a_status'=>3])
            ->orderBy('a_date DESC')
            ->all();
    }


}