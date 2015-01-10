<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="com-menu-add">

<?= $this->render('_form', [
        'model' => $model,'flag'=>$flag
    ]) ?>

</div>
