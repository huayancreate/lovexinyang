<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>

<div class="com-menu-update">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'updateMenuForm']); ?>

    <?= $form->field($model, 'menuName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'menuUrl')->textArea(['maxlength' => 200]) ?>

    <?= $form->field($model, 'isValid')->checkbox() ?>

<div class="col-lg-7">
    <div class="form-group pull-right">
        <?= Html::button( '更新', ['class' => 'btn btn-primary','id'=>'btnUpdate','onclick'=>"updateMenuFun($model->id)"]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>


<script type="text/javascript">

//后台菜单的修改
function updateMenuFun(id)
{
    $.ajax({
          type:"POST",
          url:"index.php?r=com-menu/update&id="+id,
          data:$('#updateMenuForm').serialize(),      //你的form id
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