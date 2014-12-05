<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="com-menu-reload">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'menuName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'menuUrl')->textInput(['maxlength' => 200]) ?> 

    <input type="hidden" id="parentMenuIdHdn" name="parentMenuIdHdn" value="<?=$id?>"  >


<div class="col-lg-7">
    <div class="form-group pull-right">
        <?= Html::submitButton( '保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>
