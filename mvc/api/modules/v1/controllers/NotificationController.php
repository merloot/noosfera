<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 02.04.19
 * Time: 10:05
 */

namespace api\modules\v1\controllers;

use common\models\NotificationSearch;
use yii\web\Response;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use Yii;
use yii\data\Pagination;

class NotificationController extends ActiveController
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

    public $modelClass = 'common\models\Notifications';

    public function actions() {

        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider() {

        $searchModel = new NotificationSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $pages = new Pagination([
            'totalCount' => $dataProvider
                ->query
                ->count(),
        ]);


        return $dataProvider
            ->query
            ->offset($pages->offset)
            ->Andwhere(['n_status'=>1])
            ->limit($pages->limit)
            ->all();
    }


}