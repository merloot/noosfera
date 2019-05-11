<?php

namespace backend\controllers;

use Yii;
use common\models\CompetenceProfile;
use common\models\CompetenceProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CompetenceProfileController implements the CRUD actions for CompetenceProfile model.
 */
class CompetenceProfileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CompetenceProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompetenceProfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompetenceProfile model.
     * @param integer $cp_com_id
     * @param integer $cp_p_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($cp_com_id, $cp_p_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($cp_com_id, $cp_p_id),
        ]);
    }

    /**
     * Creates a new CompetenceProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompetenceProfile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'cp_com_id' => $model->cp_com_id, 'cp_p_id' => $model->cp_p_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CompetenceProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $cp_com_id
     * @param integer $cp_p_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($cp_com_id, $cp_p_id)
    {
        $model = $this->findModel($cp_com_id, $cp_p_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'cp_com_id' => $model->cp_com_id, 'cp_p_id' => $model->cp_p_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CompetenceProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $cp_com_id
     * @param integer $cp_p_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($cp_com_id, $cp_p_id)
    {
        $this->findModel($cp_com_id, $cp_p_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CompetenceProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $cp_com_id
     * @param integer $cp_p_id
     * @return CompetenceProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($cp_com_id, $cp_p_id)
    {
        if (($model = CompetenceProfile::findOne(['cp_com_id' => $cp_com_id, 'cp_p_id' => $cp_p_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
