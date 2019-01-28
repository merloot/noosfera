<?php

namespace api\modules\v1\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use common\models\Profile;
use yii\behaviors\BlameableBehavior;
use yii;
use common\models\User;

class ProfileController extends ActiveController
{
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'p_user_id',
                'updatedByAttribute' => 'p_user_id',
            ],
            'corsFilter' => [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => [ 'POST', 'OPTIONS','GET','UPDATE'],
                    'Access-Control-Request-Headers' => ['*'],
                ],
            ],
//             'access' => [
//                 'class' => AccessControl::className(),
//                 'rules' => [
//                     [
//                         'allow' => true,
//                         'actions' => [ 'index'],
//                         'roles' => ['*'],
//                     ],
//                 ],
//             ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
        return $behaviors;
    }
    public $modelClass = 'common\models\Profile';

    public function actionsCreate()
    {
        if(!$Profile) {
            $Profile = new Profile();
            $Profile->p_name = Yii::$app->request->getBodyParam('');
            $Profile->p_second_name = Yii::$app->request->getBodyParam('');
            $Profile->p_family = Yii::$app->request->getBodyParam('');
            $Profile->p_description = Yii::$app->request->getBodyParam('');
            $Profile->p_image = Yii::$app->request->getBodyParam('');
            $Profile->p_gender = $this->p_gender = Yii::$app->request->getBodyParam('');
            $Profile->p_date = $this->p_date = Yii::$app->request->getBodyParam('');
            $Profile->save();
            $result =   [
                'success' => 1,
                'p_name' =>  $Profile->p_name,
                'p_second_name' =>  $Profile->p_second_name,
                'p_family' =>  $Profile->p_family,
                'userId' =>  $Profile->p_id,
                'gender'=> $Profile->p_gender,
                'u_date'=>$Profile->p_date,
                'payload' => $Profile,
            ];
        }
        return $result;
        }


    public function actionsUpdate()
    {


    }
}