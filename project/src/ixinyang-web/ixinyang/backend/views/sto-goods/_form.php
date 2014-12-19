<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use backend\assets\AppAsset;
use cliff363825\kindeditor\KindEditorWidget;
use kartik\form\ActiveFormss;
use kartik\widgets\FileInput;
use yii\web\Url;
use kartik\markdown\MarkdownEditor;
use backend\models\GoodsPicture;
use backend\models\FileUpload;

/* @var $this yii\web\View */
/* @var $model backend\models\StoGoods */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="sto-goods-form">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'goodsFrom',
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->field($model,'file[]')->widget(
        FileInput::className(),[
            'options'=>[
                'multiple' => true,
            ],
            'pluginOptions'=>[
                'initialPreview'=>GoodsPicture::getPicture($model->id),
                'previewFileType' => 'any',
                'showUpload'=>false,
                'browseLabel'=>'浏览文件',
                'removeLabel'=>'移除文件',
                'initialCaption'=>"请选择上传文件，多个文件请全选",
                'overwriteInitial'=>false
            ],
        ])->label("选择图片")?>

    <?= $form->field($model, 'goodsName')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'summary')->textarea() ?>

    <?= 
        $form->field($model, 'describes')->widget(KindEditorWidget::className(), [ 
            'model' => $model,
            'attribute' => 'describes',
            'clientOptions' => [ 
                'model'=>$model,
                'width' => '450', 
                'height' => 'auto', 
                'themeType' => 'default', 
                'itemType' => 'full', 
                'langType' => 'zh_CN', 
                'autoHeightMode' => true, 
                'filePostName' => 'describes', 
                'uploadJson' => yii\helpers\Url::to(['upload']), 
            ], 
        ]); 
    ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?php $categoryModel->categoryName=$model->subClass;  ?>
    <?= $form->field($categoryModel, 'categoryName')->dropDownList(
        ArrayHelper::map($categoryList, 'id', 'categoryName'),
        ['prompt' => '--商品类别--'])->label('类别') ?>

     <input type="hidden" id="storeType" name="StoGoods[subClass]" value=<?= $model->subClass ?>> 

    <?= $form->field($model, 'validity')->checkbox() ?>

    <?= $form->field($model, 'supplyDateTime')->textInput() ?>

    <?= $form->field($model, 'enjoyRebate')->textInput() ?>

    <?= $form->field($model, 'goodsState')->checkbox() ?>

    <div style="text-align:right;margin:10px;">
        <?= Html::submitButton($model->isNewRecord ? '保存' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>