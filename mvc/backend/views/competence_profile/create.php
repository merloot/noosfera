<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CompetenceProfile */

$this->title = 'Create CompetencePController Profile';
$this->params['breadcrumbs'][] = ['label' => 'CompetencePController Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="competence-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
