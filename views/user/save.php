<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add User';
?>
<style>.form-group {margin-bottom: 8px;}</style>
<div class="container">
<div class="radius_box mobile-radius_box">
<div class="modal-header">      
    <h4 class="modal-title"><?php echo $this->title; ?></h4>
</div>

<div class="modal-body">
   <?php $form = ActiveForm::begin();?>
    <div class="row">
        <div class="form-group col-lg-6 col-md-6">
			<label class="col-sm-4 control-label">First Name</label>
			<div class="col-sm-8"><?php echo $form->field($model, 'first_name')->textInput(['placeholder' => USER_REGISTERASLENDER_FIRSTNAME])->label(false); ?></div>				  
		</div>
		<div class="form-group col-lg-6 col-md-6">
			<label class="col-sm-4 control-label">Last Name</label>
			<div class="col-sm-8"><?php  echo $form->field($model, 'last_name')->textInput(['placeholder' => USER_SAVE_LASTNAME])->label(false); ?></div>				  
		</div>		
	</div>
	
	<div class="row">
        <div class="form-group col-lg-6 col-md-6">
			<label class="col-sm-4 control-label">Username</label>
			<div class="col-sm-8"><?php echo $form->field($model, 'username')->textInput(['placeholder' => USER_SAVE_USERNAME])->label(false); ?></div>				  
		</div>
		<div class="form-group col-lg-6 col-md-6">
			<label class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8"><?php echo $form->field($model, 'email')->textInput(['placeholder' => USER_SAVE_EMAIL])->label(false); ?></div>				  
		</div>		
	</div>
	
	<div class="row">
        <div class="form-group col-lg-6 col-md-6">
			<label class="col-sm-4 control-label">Password</label>
			<div class="col-sm-8"><?php echo $form->field($model, 'password')->passwordInput(["placeholder" => USER_SAVE_PASSWORD])->label(false); ?></div>				  
		</div>
		<div class="form-group col-lg-6 col-md-6">
			<label class="col-sm-4 control-label">Confirm Password</label>
			<div class="col-sm-8"><?php echo $form->field($model, 'confirm_password')->passwordInput(["placeholder" => USER_SAVE_CONFIRMPASSWORD])->label(false); ?></div>				  
		</div>		
	</div>
	<div class="clearfix"></div>
	</div>
	<div class="modal-footer">
		<div class="row">             
		  <div class="col-sm-12 text-center"><?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?></div>
		</div>
   </div>
<?php ActiveForm::end(); ?>
<div class="clearfix"></div> 
</div>
</div>