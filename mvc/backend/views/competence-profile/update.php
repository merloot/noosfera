<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompetenceProfile */

$this->title = 'Update Competence Profile: ' . $model->cp_com_id;
$this->params['breadcrumbs'][] = ['label' => 'Competence Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cp_com_id, 'url' => ['view', 'cp_com_id' => $model->cp_com_id, 'cp_p_id' => $model->cp_p_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="competence-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
