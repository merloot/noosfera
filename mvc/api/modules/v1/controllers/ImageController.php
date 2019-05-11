<?php


namespace api\modules\v1\controllers;

use common\models\Image;
use yii\filters\ContentNegotiator;
use yii\rest\ActiveController;
use yii\web\Response;
use yii\web\UploadedFile;

class ImageController extends ActiveController
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

    public $modelClass = 'common\models\Image';


    public function actionUpload()
    {
        $model = new Image();
        $model->load ( \Yii::$app->getRequest ()->getBodyParams (), '' );
        $image =UploadedFile::getInstanceByName ( 'i_image' );
        if (is_object ( $image )) {
            $name =$model->i_image = time () . "_" . uniqid () . '.' . $image->extension;
            $imageDir = \Yii::getAlias ( '@avatar' );
            $image->saveAs ( $imageDir . '/' . $model->i_image );
            $model->i_user_id = \Yii::$app->request->getBodyParam('i_user_id');
            $model->i_image = $name;
            \Yii::info ( 'New image saved,: ' . $model->i_user_id, __METHOD__ );
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