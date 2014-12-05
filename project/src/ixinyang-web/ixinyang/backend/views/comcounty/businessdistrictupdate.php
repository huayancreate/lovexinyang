<?php

use yii\helpers\Html;
use backend\models\ComBusinessDistrict;
use backend\controllers\ComcountyController;

/* @var $this yii\web\View */
/* @var $model backend\models\ComCounty */

$this->title = 'Update Com County: ' . ' ' . $model->countyId;
$this->params['breadcrumbs'][] = ['label' => '商圈配置', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '商圈配置修改', 'url' => ['view', 'id' => $model->countyId]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="comcounty-businessdistrictupdate">

   <!--  <h1><?= Html::encode($this->title) ?></h1> -->
<div class="row">
	<div class="col-lg-12">
		 <?= $this->render('_businessdistrictform', [
         'model'=>$model,'models'=>$models,'ComBusinessDistrict'=>$ComBusinessDistrict,
         'countyId'=>$countyId,
    ]) ?>
	</div>
</div> 
   

</div>
