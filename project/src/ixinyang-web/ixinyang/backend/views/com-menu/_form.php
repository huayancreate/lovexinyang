<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<div class="com-menu-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal','id'=>'addMenuForm']); ?>

    <?= $form->field($model, 'menuName')->textInput(['maxlength' => 50]) ?>

   
    <?= $form->field($model, 'menuUrl')->textArea(['maxlength' => 200]) ?> 
    

    <?= $form->field($model, 'isValid')->checkbox() ?>

    <input type="hidden" id="parentMenuIdHdn" name="parentMenuIdHdn" value="<?= $model->id ?>"  >


<div class="col-lg-7">
    <div class="form-group pull-right">
       <?= Html::submitButton($model->isNewRecord ? '保存' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>
<script type="text/javascript">
  $(function(){
    $("#addMenuForm").on("submit", function(event) {
      if (<?php echo  $flag ?>==1) {
          if ($("#commenu-menuurl").val()=="" || $("#commenu-menuurl").val()==undefined) {
             alert('请填写后台菜单路径');
             return false;
          }
      }
    });
    
  });
</script>
