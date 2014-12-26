<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdPushMessage */

$this->title = 'Create Ad Push Message';
$this->params['breadcrumbs'][] = ['label' => 'Ad Push Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ad-push-message-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
