<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 22.02.19
 * Time: 17:02
 */

namespace api\modules\v1\controllers;


use common\models\TagconSearch;
use yii\data\Pagination;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

class Tag_conController extends ActiveController
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


    public $modelClass = 'common\models\TagsConsultation';

    public function prepareDataProvider() {

        $searchModel = new TagconSearch();

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
            ->all();
    }


}