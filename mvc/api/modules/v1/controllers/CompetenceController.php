<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 13.02.19
 * Time: 14:54
 */

namespace api\modules\v1\controllers;

use common\models\CompetenceProfile;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;

class CompetenceController extends ActiveController
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

    public $modelClass = 'common\models\CompetenceProfile';


    public function actionKill()
    {



        return CompetenceProfile::deleteAll([
           'cp_p_id'=>$_POST['cp_p_id'],
           'cp_com_id'=>$_POST['cp_com_id'],
        ]);

    }
}
