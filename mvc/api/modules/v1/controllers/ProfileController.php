<?php

namespace api\modules\v1\controllers;

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
}