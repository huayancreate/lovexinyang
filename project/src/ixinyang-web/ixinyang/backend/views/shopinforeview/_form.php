<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use cliff363825\kindeditor\KindEditorWidget;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopInfoReview */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-info-review-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal',]); ?>
    <!--店铺名称-->
    <?= $form->field($model, 'shopName')->textInput(['maxlength' => 50]) ?>
    <!--联系方式-->
    <?= $form->field($model, 'contact')->textInput(['maxlength' => 50]) ?>
    <!--城市-->   
    <?= $form->field($cityModel, 'cityCenterName')->dropDownList(ArrayHelper::map($cityList, 'id', 'cityCenterName'), ['prompt' => '--城市--']) ?>
    <!--区域-->
    <?= $form->field($countyModel, 'countyName')->dropDownList(ArrayHelper::map($countyList,'countyId','countyName'), ['prompt' => '--区域--']) ?>
    <!--商圈-->
    <?= $form->field($busidistModel, 'businessDistrictName')->dropDownList(ArrayHelper::map($busidistList,'businessDistrictId','businessDistrictName'), ['prompt' => '--商圈--']) ?>
    <!--详细地址-->
    <?= $form->field($model, 'address')->textInput(['maxlength' => 250]) ?>
    <!--营业时间-->
    <?= $form->field($model, 'businessHours')->textInput(['maxlength' => 100]) ?>
    <!--门店概述-->
    <?= 
        $form->field($model, 'storeOutline')->widget(KindEditorWidget::className(), [ 
            'clientOptions' => [ 
            'width' => '400', 
            'height' => 'auto', 
            'themeType' => 'default', 
            'itemType' => 'full', 
            'langType' => 'zh_CN', 
            'autoHeightMode' => true, 
            'filePostName' => 'fileData', 
            // 'uploadJson' => Url::to(['upload']), 
            ], 
        ]); 
    ?> 
    <?= $form->field($model, 'storeOutline')->textarea(['rows' => 6]) ?>
    <!--地图经度-->
    <?= $form->field($model, 'longitude')->textInput() ?>
    <!--地图纬度-->
    <?= $form->field($model, 'latitude')->textInput() ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
