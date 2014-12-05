<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="com-menu-update">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'menuName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'menuUrl')->textInput(['maxlength' => 200]) ?>

<div class="col-lg-7">
    <div class="form-group pull-right">
        <?= Html::submitButton( '更新', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>
