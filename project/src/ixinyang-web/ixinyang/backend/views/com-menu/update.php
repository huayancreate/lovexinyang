<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="com-menu-update">

 <?= $this->render('_form', [
        'model' => $model,'flag'=>$flag
    ]) ?>

</div>


