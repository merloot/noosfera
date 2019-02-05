<?php
namespace api\modules\v1\controllers;

use yii\filters\Cors;
use yii\rest\ActiveController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii;
use api\modules\v1\models\User;
use api\modules\v1\models\Token;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use sizeg\jwt\JwtHttpBearerAuth;


class UserController extends ActiveController
{

    public function behaviors()
    {
       return [
            'corsFilter' => [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => [ 'POST', 'OPTIONS', 'GET','DELETE'],
                    'Access-Control-Request-Headers' => ['*'],
                ],
            ],

           'authenticator' => [
               'class' => CompositeAuth::className(),
               'authMethods' => [
                   HttpBasicAuth::className(),
                   HttpBearerAuth::className(),
                   QueryParamAuth::className(),
                   JwtHttpBearerAuth::className(),
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

//    public $moduleClass = 'api\modules\v1\models\Token';
    public $modelClass = 'api\modules\v1\models\User';
//    public $modelClass = 'common\models\User';



    public function actionToken()
    {
        $token = Yii::$app->jwt->getBuilder()
            ->setIssuer('http://localhost/noosfera/public_html/api') // Configures the issuer (iss claim)
            ->setAudience('http://localhost/noosfera/public_html/api') // Configures the audience (aud claim)
            ->setId('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
            ->setIssuedAt(time()) // Configures the time that the token was issue (iat claim)
            ->setNotBefore(time() + 60) // Configures the time before which the token cannot be accepted (nbf claim)
            ->setExpiration(time() + 3600) // Configures the expiration time of the token (exp claim)
            ->set('uid', 1) // Configures a new claim, called "uid"
            ->getToken(); // Retrieves the generated token


        $token->getHeaders(); // Retrieves the token headers
        $token->getClaims(); // Retrieves the token claims

        echo $token->getHeader('jti'); // will print "4f1g23a12aa"
        echo $token->getClaim('iss'); // will print "http://example.com"
        echo $token->getClaim('uid'); // will print "1"
        echo $token; // The string representation of the object is a JWT string (pretty easy, right?)
    }
    public function actionTest()

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
            $user->setPassword(Yii::$app->request->getBodyParam('password'));
            $user->generateAuthKey();
            $token = $this->createToken();
            $user->save();
            $result =   [
                'success' => 1,
                'email' =>  $user->email,
                'userId' =>  $user->id,
                'payload' => $user,
                'token' => $token->token
            ];
        }
        var_dump($user);

        return $result;
    }
}

