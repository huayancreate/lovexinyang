<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\Dialog;

?>
 <p>
        <?= Html::button( '添加', ['class' => 'btn btn-success','id'=>'btnAdd','onclick'=>"addAd()"]) ?>
    </p>
<?php \yii\widgets\Pjax::begin(['id'=>'adGridList']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'photoUrl',
            'mapLink',
            'mapOrder',
             [
                'attribute'=>'isValid',
                'label'=>'是否有效',
                'value'=>function($data){
                  
                  return $data['isValid']==1 ? "有效": "无效";
                }
            ],

             ['class' => 'yii\grid\ActionColumn','header'=>'操作','headerOptions'=>['width'=>'100'],
                'buttons'=>[

                        'view'=>function(){
                             
                            },
                        'update'=>function(){

                        },

                        'delete'=>function($url,$model){
                        	 if ($model['isValid']=='1') {
                               return Html::a('置为无效',
                              Yii::$app->urlManager->createUrl(['ad-advertisement/delete','id' => $model['id']]),
                                [
                                 'title' => Yii::t('yii', 'Delete'),
                                'data-pjax' => '0',
                                 'data' => [
                                      'confirm' => '确定要将该广告置为无效吗?',
                                      'method' => 'post',
                                    ]
                                ]
                                );
                           }
                        },

                 ]
           ],
        ],
    ]); ?>

 <?php \yii\widgets\Pjax::end(); ?>