<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 11.02.19
 * Time: 15:38
 */

namespace api\modules\v1\controllers;


use yii\rest\ActiveController;
use yii\filters\ContentNegotiator;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\web\Response;

class ConsultationController extends ActiveController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['ContentNegotiator']=[
            'class'=> ContentNegotiator::class,
            'formats' =>[
                'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML,
            ]
        ];

        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
        ];

        return $behaviors;
    }


    public $modelClass = 'common\models\Consultation';

}