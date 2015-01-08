<?php
/**
 * Created by PhpStorm.
 * User: olebar
 * Date: 2014/10/23
 * Time: 11:59:51
 */

$this->params['breadcrumbs'] = [
    [
        'label'=>'路由管理',
        'url'=>\yii\helpers\Url::toRoute(['sys/menu'])
    ],
    '添加路由'
];
use yii\helpers\Html;
?>

<div class="col-lg-6">
    <?php $form = \kartik\widgets\ActiveForm::begin([
        'action'=>\yii\helpers\Url::toRoute('/sys/menumange'),
        //'validationUrl'=>\yii\helpers\Url::toRoute('/sys/ajaxvalidate'),
    ]) ?>

    <?= $form->field($model,'menuname')->textInput() ?>
    <?= $form->field($model,'route')->textInput()->hint('必须要按照\'controller/action\'格式书写') ?>
    <?= $form->field($model,'menuicon')->textInput()->hint('参照Bootstrap图标') ?>
    <?= $form->field($model,'parentid')->dropDownList([
        '1'=>'一级菜单',
        '2'=>'二级菜单',
        '3'=>'三级菜单',
    ],[
        'options'=>[
            '1'=>['disabled'=>($model->parentid==0)?false:true],
            '2'=>['disabled'=>($model->parentid==0)?false:true],
            '3'=>['disabled'=>($model->parentid==0)?false:true]
        ]
    ]) ?>
    <?= Html::activeHiddenInput($model,'parentid') ?>
    <?= Html::activeHiddenInput($model,'id') ?>
    <div class="form-group center">
            <?= Html::submitButton('提交', ['class' => 'btn btn-lg btn-primary']) ?>
    </div>
    <?php $form ->end() ?>
</div>