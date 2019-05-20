<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CompetenceProfile */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="competence-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cp_com_id')->textInput() ?>

    <?= $form->field($model, 'cp_p_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
