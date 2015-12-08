<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<?php //echo $this->title = "SMS verification"; ?>
<div class="container top-bottom_padding">
<div class="col-md-6 col-sm-8 col-sm-10 login_box">
	<div class="modal-header title_bottomMargin0">      
        <h4 class="modal-title"> SMS Verification<?php //echo $this->title; ?></h4>
    </div>
	<div class="modal-body">
		 <?php $form = ActiveForm::begin(); ?>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="Email">SMS Code</label>
			<div class="col-sm-8">
			   <?php echo $form->field($model, 'verify_code')->textInput(['placeholder' => USER_VERIFYSMS_VERIFYCODE])->label(false); ?>         
           	</div>
		</div>
	  <div class="clearfix"></div>
	 </div>
	<div class="panel-footer">
		<div class="row">
		    <div class="col-lg-12 text-center"><?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?></div>
		</div>
	</div>
	  <?php ActiveForm::end(); ?>
  </div>
</div>