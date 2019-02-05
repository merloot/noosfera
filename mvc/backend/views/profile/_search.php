<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'p_id') ?>

    <?= $form->field($model, 'p_user_id') ?>

    <?= $form->field($model, 'p_name') ?>

    <?= $form->field($model, 'p_second_name') ?>

    <?= $form->field($model, 'p_family') ?>

    <?php // echo $form->field($model, 'p_description') ?>

    <?php // echo $form->field($model, 'p_image') ?>

    <?php // echo $form->field($model, 'p_gender')->checkbox() ?>

    <?php // echo $form->field($model, 'p_date') ?>

    <?php // echo $form->field($model, 'p_id_profile_competence') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
