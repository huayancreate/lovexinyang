<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCounty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-county-form">


    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'createForm']); ?>
	
	<?php $mCity->cityCenterName=$cityCenterId;?>
	<?=$form->field($mCity,'cityCenterName')->dropDownList(ArrayHelper::map($mCitys,'id','cityCenterName')) ?>

    <?= $form->field($model, 'countyName')->textInput(['maxlength' => 200]) ?>
	
	<?= $form->field($model, 'isValid')->checkbox() ?>

	<div class="col-lg-offset-5">
	    <div class="form-group">
	       <?= Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	</div>
    <?php ActiveForm::end(); ?>


</div>

