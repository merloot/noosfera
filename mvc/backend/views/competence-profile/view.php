<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CompetenceProfile */

$this->title = $model->cp_com_id;
$this->params['breadcrumbs'][] = ['label' => 'Competence Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="competence-profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'cp_com_id' => $model->cp_com_id, 'cp_p_id' => $model->cp_p_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'cp_com_id' => $model->cp_com_id, 'cp_p_id' => $model->cp_p_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'cp_id',
            'cp_com_id',
            'cp_p_id',
        ],
    ]) ?>

</div>
