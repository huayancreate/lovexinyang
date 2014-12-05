<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCounty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-county-update">


    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'countyName')->textInput(['maxlength' => 200]) ?>

	<?php $mCity->cityCenterName=$cityCenterId;?>
   
    <?=$form->field($mCity,'cityCenterName')->dropDownList(ArrayHelper::map($mCitys,'id','cityCenterName')) ?>

<div class="col-lg-offset-5">

    <div class="form-group">
        <?= Html::submitButton('更新', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>


</div>
