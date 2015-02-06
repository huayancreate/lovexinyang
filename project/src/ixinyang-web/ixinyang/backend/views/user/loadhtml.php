<?php

use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'id'=>'userform',
    'layout' => 'horizontal',
]) ?>

<?= $form->field($model,'username')->textInput()->hint("<font color='red'>*</font>")->label("账号") ?>
<?= $form->field($model,'password')->passwordInput()->hint("<font color='red'>*</font>")->label("密码") ?>
<center>
    <?=\yii\helpers\Html::submitButton('保存',['class'=>'btn btn-success'])?>
</center>
<?php $form->end() ?>