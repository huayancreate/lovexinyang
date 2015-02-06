<?php
/**
 * Created by PhpStorm.
 * User: olebar
 * Date: 2014/10/23
 * Time: 11:59:51
 */
$this->params['breadcrumbs'] = [
    [
        'label' => '路由管理',
        'url' => \yii\helpers\Url::toRoute(['sys/menu'])
    ],
    '添加路由'
];

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
?>

<div class="col-lg-6">
    <?php
    $form = \kartik\widgets\ActiveForm::begin([
                'action' => \yii\helpers\Url::toRoute('/sys/menumange'),
                //'validationUrl'=>\yii\helpers\Url::toRoute('/sys/ajaxvalidate'),
            ])
    ?>

    <?= $form->field($model, 'name')->textInput() ?>
    <?= $form->field($model, 'route')->textInput()->hint('必须要按照\'controller/action\'格式书写') ?>
    <?= $form->field($model, 'menuicon')->textInput()->hint('参照Bootstrap图标') ?>

    <?= Html::activeHiddenInput($model, 'id',['id'=>'sonId']) ?>
    
    
    <?=$form->field($model, 'parentid')->dropDownList(
            ArrayHelper::map($menuFather, 'id', 'name'),
            ['id' => 'cat-id','prompt'=>'爱信阳菜单管理'])
        ->label("模块");
    ?>
    <!--这里是通过模块选择后筛选菜单项，备用-->
    <!--<?=$form->field($model, 'id')->widget(DepDrop::classname(), [
       'type' => DepDrop::TYPE_SELECT2,
        'data'=>ArrayHelper::map($menuSon, 'id', 'name'),
        'options'=>['id'=>'subcat1-id', 'placeholder'=>'Select ...'],
        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
        'pluginOptions' => [
            'depends' => ['cat-id'],
            'placeholder' => '请选择菜单项', 
            'allowClear' => true,
            'url' => Url::to(['/sys/subcat']),
        ]
    ])->label("菜单");
    ?>-->
       
    <div class="form-group center">
    <?= Html::submitButton('提交', ['class' => 'btn btn-lg btn-primary']) ?>
    </div>

    <?php ?>

<?php $form->end() ?>
</div>