<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCounty */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="com-county-create">


   <?= $this->render('_form', [
         'model' => $model,
         'mCity'=>$mCity,
         'mCitys'=>$mCitys,
         'cityCenterId'=>$cityCenterId,
    ]) ?>


</div>

