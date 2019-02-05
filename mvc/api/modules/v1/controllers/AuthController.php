<?php
/**
 * Created by PhpStorm.
 * User: user14
 * Date: 05.02.19
 * Time: 10:46
 */


namespace api\modules\v1\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use api\modules\v1\models\User;
use common\models\Token;
use yii\filters\Cors;
use sizeg\jwt\JwtHttpBearerAuth;


class AuthController extends Controller
{

    public $email;
    public $password;
    private $_user;

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
            'authenticator'=> [
                'class' => JwtHttpBearerAuth::class,
            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'index'=>['post', 'options'],
//                ]
//            ],
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'actions' => [ 'index'],
//                        'roles' => ['*'],
//                    ],
//                ],
//            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];
    }
    public $modelClass = 'api\modules\v1\models\User';

    public function actionsAuth()
    {

        

    }

//    public function rules()
//    {
//        return [
//            // username and password are both required
//            [['email', 'password'], 'required'],
//            // password is validated by validatePassword()
//            ['password', 'validatePassword'],
//        ];
//    }
//    public function validatePassword($attribute, $params)
//    {
//        if (!$this->hasErrors()) {
//            $user = $this->getUser();
//            if (!$user || !$user->validatePassword($this->password)) {
//                $this->addError($attribute, 'Incorrect username or password.');
//            }
//        }
//    }
//    public function login()
//    {
//        if ($this->validate()) {
//            return Yii::$app->user->login($this->getUser());
//        }
//
//        return false;
//    }
//    /**
//     * Finds user by [[username]]
//     *
//     * @return User|null
//     */
//    protected function getUser()
//    {
//        if ($this->_user === null) {
//            $this->_user = User::findByEmail($this->email);
//        }
//        return $this->_user;
//    }
}