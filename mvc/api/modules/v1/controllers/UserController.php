<?php

namespace api\modules\v1\controllers;


use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii;
use api\modules\v1\models\User;
use sizeg\jwt\JwtHttpBearerAuth;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use yii\filters\Cors;
use common\models\Profile;


class UserController extends ActiveController
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

    public $modelClass = 'api\modules\v1\models\User';

    public function actionReg()

    {
        $this->enableCsrfValidation = false;
        $user = User::findByEmail(Yii::$app->request->getBodyParam('email'));
        if ($user) {
         return [
             'success' => false,
             'message' => 'User with this email already exist',
             'code' => 'email_busy'
         ];
        }

        $user = new User();
        $user->email = Yii::$app->request->getBodyParam('');
        $user->setPassword(Yii::$app->request->getBodyParam('password'));
        $user->generateAuthKey();
        $user->save();

        return   [
            'success' => 1,
            'email' =>  $user->email,
            'userId' =>  $user->id,
            'payload' => $user,
        ];
    }

    public function actionLogin()

    {

        $user = User::findByEmail(Yii::$app->request->getBodyParam('email'));
        if (!$user)
        {
            return [
                'success' =>false,
                'message' => 'Incorrect email'
            ];

        }

        if($user)
            if (!$user->validatePassword(Yii::$app->request->getBodyParam('password'))) {
                return  [
                    'success' => false,
                    'message' => 'Incorrect password'
                ];
            }
            else{
                $signer = new Sha256();
                $token = Yii::$app->jwt->getBuilder()
                    ->set('id', $user->getPrimaryKey())
                    ->sign($signer,Yii::$app->jwt->key)
                    ->getToken();

                return  [
                    'success'=> true,
                    'data'=> (string) ($token),
                    'id'=> $user->getPrimaryKey(),
//                    'p_id'=> $user->Profile->p_user_id,
                    'p_id'=>Profile::find()->select('p_id')->where(['p_user_id'=>$user->getPrimaryKey()])->one(),
                ];


            }
    }

}

