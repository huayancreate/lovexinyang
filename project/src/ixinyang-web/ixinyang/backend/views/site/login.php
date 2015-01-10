<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = '爱信阳-商家管理登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal'
            ]); ?>
        
            <div style="height:60px;" class="row">
                <?php
                    if( Yii::$app->getSession()->hasFlash('error') ) {
                        echo Alert::widget([
                            'options' => [
                                'class' => 'alert-warning col-sm-5',
                            ],
                            'body' => Yii::$app->getSession()->getFlash('error'),
                        ]);
                    }
                ?>
            </div>
            <br/>

            <?=
                $form->field($model, 'username', [
                    'template' => '{label} <div class="row"><div class="col-sm-5">{input}</div>{error}</div>'
                ])->textInput([
                    'placeholder'=>"账号",
            ])->label("账号") ?>

            <?=
                $form->field($model, 'password', [
                    'template' => '{label} <div class="row"><div class="col-sm-5">{input}</div>{error}</div>'
                ])->passwordInput([
                    'placeholder'=>"密码",
            ])->label("密码") ?>

            <?= $form->field($model, 'rememberMe')->checkbox()->label("记住密码") ?> 

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>


