<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'p_user_id')->textInput() ?>

    <?= $form->field($model, 'p_name')->textInput() ?>

    <?= $form->field($model, 'p_second_name')->textInput() ?>

    <?= $form->field($model, 'p_family')->textInput() ?>

    <?= $form->field($model, 'p_description')->textInput() ?>

    <?= $form->field($model, 'p_image')->textInput() ?>

    <?= $form->field($model, 'p_gender')->checkbox() ?>

    <?= $form->field($model, 'p_date')->textInput() ?>

    <?= $form->field($model, 'p_id_profile_competence')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
