<?php

namespace api\modules\v1\controllers;

use common\models\Consultation;
use common\models\Profile;
use yii\data\Pagination;
use common\models\ProfileSearch;
use yii;
use yii\web\Response;
use yii\rest\ActiveController;
use sizeg\jwt\JwtHttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\web\UploadedFile;

class ProfileController extends ActiveController
{
    public $p_image;
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['ContentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
            ],
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

    public $modelClass = 'common\models\Profile';

    public function actionUpload()
    {
        $model = new Profile();
        $model->load ( \Yii::$app->getRequest ()->getBodyParams (), '' );
        $image =UploadedFile::getInstanceByName ( 'p_image' );
        if (is_object ( $image )) {
            $name =$model->p_image = time () . "_" . uniqid () . '.' . $image->extension;
            $imageDir = \Yii::getAlias ( '@avatar' );
            $image->saveAs ( $imageDir . '/' . $model->p_image );
            $model->p_image = $name;
            \Yii::info ( 'New image saved,: ' . $model->p_user_id, __METHOD__ );
        } else {
            \Yii::info ( 'This is not image object!!', __METHOD__ );
        }
        if ($model->save()) {
            $response = \Yii::$app->getResponse ();
            $response->setStatusCode ( 201 );
        } elseif (! $model->hasErrors ()) {
            $response->setStatusCode ( 500 );
            throw new yii\web\ServerErrorHttpException( 'Failed to create the object for unknown reason.' );

        }
        return $model;
    }

    public function actionBuy($sender_id, $recipient_id,$con_id)
    {
        $model = new Profile();
        $sender = $model->find()->where(['p_user_id'=>$sender_id])->asArray()->one();
        $recipient = $model->find()->where(['p_user_id'=>$recipient_id])->asArray()->one();
        $consultation = Consultation::find()->where(['con_id'=>$con_id])->asArray()->one();

        $buy = $sender['p_balance']-$consultation['con_price'];
        $sell = $recipient['p_balance']+$consultation['con_price'];
        var_dump($sender->update('',''));
        die();
        $model->save();

//        Yii::$app->db->createCommand()->update('Profile',['p_balance'],['p_user_id'=>$sender_id],$buy)->execute();
//        Yii::$app->db->createCommand()->update('Profile',['p_balance'],['p_user_id'=>$recipient_id],$sell)->execute();


         return[
             $sell, $buy
//
    ];
    }
}