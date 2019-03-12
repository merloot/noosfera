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
//        $behaviors['authenticator'] = [
//            'class' => JwtHttpBearerAuth::class,
//            ];

        return $behaviors;
    }

    public $serializer = [
        'class'=>'yii\rest\Serializer',
        'collectionEnvelope'=>'items',
    ];

    public $modelClass = 'api\modules\v1\models\User';

    public function actionLogin()
    {

        $user = User::findByEmail(Yii::$app
            ->request
            ->getBodyParam('email')
        );
        if (!$user)
        {
            return [
                'success' =>false,
                'message' => 'Incorrect email'
            ];

        }

        if($user)
            if (!$user->validatePassword(Yii::$app
                ->request
                ->getBodyParam('password'))) {
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
//                    'p_id'=> $user->profile->p_user_id,
                    'p_id'=>Profile::find()
                        ->select('p_id')
                        ->where(['p_user_id'=>$user->getPrimaryKey()])
                        ->one(),
                ];


            }
    }

}

