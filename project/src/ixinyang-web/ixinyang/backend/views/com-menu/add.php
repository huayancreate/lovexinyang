<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="com-menu-add">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'addMenuForm']); ?>

    <?= $form->field($model, 'menuName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'menuUrl')->textArea(['maxlength' => 200]) ?> 

    <?= $form->field($model, 'isValid')->checkbox() ?>

    <input type="hidden" id="parentMenuIdHdn" name="parentMenuIdHdn" value="<?= $model->id ?>"  >


<div class="col-lg-7">
    <div class="form-group pull-right">
        <?= Html::button( '保存', ['class' => 'btn btn-success','id'=>'btnAdd','onclick'=>"addMenuFun($model->id,$model->isValid)"]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>
<script type="text/javascript">
//后台菜单的添加
function addMenuFun(id,isValid)
{
    $.ajax({
          type:"POST",
          url:"index.php?r=com-menu/add&id="+id+"&isValid="+isValid,
          data:$('#addMenuForm').serialize(),      //你的form id
          dataType:'json',
         error: function (request) {
             alert("Connection error");
         },
         success:function(data) {
            if(data.success){
             //当成功后操作。。
               alert("操作成功.");
              window.location.href='index.php?r=com-menu/index';
            }else{
             alert(data.menuName+'\n'+data.menuUrl);
            }
         }
     });
}

	
</script>