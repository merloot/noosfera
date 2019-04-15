<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 11.02.19
 * Time: 15:38
 */

namespace api\modules\v1\controllers;


use common\models\ConsultationSearch;
use yii\data\Pagination;
use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\web\Response;
use Yii;
class ConsultationController extends ActiveController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['ContentNegotiator']=[
            'class'=> ContentNegotiator::class,
            'formats' =>[
                'application/json' => Response::FORMAT_JSON,
//                'application/xml' => Response::FORMAT_XML,
            ]
        ];

//        $behaviors['authenticator'] = [
//            'class' => JwtHttpBearerAuth::class,
//        ];

        return $behaviors;
    }


    public $modelClass = 'common\models\Consultation';


    public function actions() {

        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider() {

        $searchModel = new ConsultationSearch();

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
            ->orderBy('con_date')
            ->all();
    }


}