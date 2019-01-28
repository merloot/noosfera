<?php
namespace api\modules\v1\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use common\models\Token;
use yii;
use common\models\User;

class UserController extends ActiveController
{
//    public $password = "";

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
    public $modelClass = 'common\models\User';


    public function actionCreate()

    {
        \Yii::$app->response->format = Response:: FORMAT_JSON;
            $this->enableCsrfValidation = false;
            $user = User::findByEmail(Yii::$app->request->getBodyParam('email'));
            {
                $result =  [
                    'success' => 0,
                    'message' => 'User with this email already exist',
                    'code' => 'email_busy'
                ];
        }
        if(!$user){
            $user = new User();
            $user->email = Yii::$app->request->getBodyParam('');
            $user->setPassword($this->password)(Yii::$app->request->getBodyParam('password'));
            $user->generateAuthKey();
            $user->save();
            $token = $this->generateToken($user->id);
            $result =   [
                'success' => 1,
                'email' =>  $user->email,
                'userId' =>  $user->id,
                'payload' => $user,
                'token' => $token->token
            ];
        }
        return $result;
    }
    public function beforeSave($insert) {
        if ($this->password) {
            $this->setPassword($this->password);
        }
        return parent::beforeSave($insert);
    }
}

