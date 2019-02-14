<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompetenceProfile */

$this->title = 'Update CompetenceController Profile: ' . $model->cp_id;
$this->params['breadcrumbs'][] = ['label' => 'CompetenceController Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cp_id, 'url' => ['view', 'id' => $model->cp_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="competence-profile-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
