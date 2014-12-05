<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\StoApplyInfo */

$this->title = '商家申请';
$this->params['breadcrumbs'][] ='申请合作';
?>
<div class="sto-apply-info-create">
<h4><?= Html::encode($this->title) ?></h4>
    <?= $this->render('_form', [
        'model' => $model,'citys'=>$citys
    ]) ?>
</div>












