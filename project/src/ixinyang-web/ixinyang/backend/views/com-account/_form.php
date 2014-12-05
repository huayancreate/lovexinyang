<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComAccount */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-accoun-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'accountForm']); ?>
    <div class="col-lg-5">
    <?= $form->field($model, 'userName')->textInput(['maxlencontrol-labelgth' => 50]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'sex')->inline()->radioList(['男'=>'男','女'=>'女'])?>

    <?php $role->roleName = $roleId?>
    <?= $form->field($role, 'roleName')->dropDownList(ArrayHelper::map($roles, 'id', 'roleName'),['prompt' => '--选择角色--']) ?>


    </div>

    <div class="col-lg-5">
    <?= $form->field($model, 'nickname')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'phoneNumber')->textInput(['maxlength' => 20]) ?>
 </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
echo common\hyControl\Map::widget([

]);
?>