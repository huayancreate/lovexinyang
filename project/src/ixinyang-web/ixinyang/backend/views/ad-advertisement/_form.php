<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Ad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'advertisementForm']); ?>

 <div class="row">
 <div class="col-lg-8">
    <?= $form->field($model, 'photoUrl')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'mapLink')->textArea(['maxlength' => 200]) ?>

    <?= $form->field($model, 'mapOrder')->textInput() ?>

    <?= $form->field($model, 'adName')->textInput(['maxlength' => 200]) ?>

        <?= 
            $form->field($model,'startDate')->widget(
            DatePicker::className(),[
                    'language' => 'zh-CN',
                    'id'  => 'startDate',
                    'name'  => 'startDate',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' =>
                    [//写属性
                        'inline'=>true,
                        'changeMonth' => true,
                    ],
                   ])
       ?>

    
      <?= 
        $form->field($model,'endDate')->widget(
        DatePicker::className(),[
                'language' => 'zh-CN',
                'id'  => 'endDate',
                'name'  => 'endDate',
                'dateFormat' => 'yyyy-MM-dd',
                'clientOptions' =>
                [//写属性
                    'inline'=>true,
                    'changeMonth' => true,
                ],
               ])
      ?>

    <?= $form->field($model, 'isValid')->checkbox() ?>
   

<!-- <div class="col-lg-7">
    <div class="form-group pull-right">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div> -->
    <?php ActiveForm::end(); ?>

 </div>
</div>

</div>
