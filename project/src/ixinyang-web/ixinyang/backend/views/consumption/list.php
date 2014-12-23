<?php
	use yii\grid\GridView;
?>

 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'verifierTime',
            'costPrice',
            'rebate',
            'payablePrice',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
