<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\ComCityCenter;
use backend\controllers\ComcountyController;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCounty */

$this->title = '商圈配置查看';
$this->params['breadcrumbs'][] = ['label' => '商圈配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="com-county-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $Businessdistricmodel,
        'attributes' => [
            [
                'attribute'=>'countyId',
                'format'=>'raw',  
                'value'=> $ComCountyModel->countyName,
            ],

            'businessDistrictCode',
            'businessDistrictName',
        ],
    ]) ?>
</div>
