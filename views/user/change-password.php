<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Change Password';
?>
<div class="container top-bottom_padding">
<div class="col-md-6 col-sm-8 col-sm-10 login_box">
	<div class="modal-header title_bottomMargin0">      
        <h4 class="modal-title"><?php echo $this->title; ?></h4>
    </div>
    <?php $form = ActiveForm::begin(isset($action) ? $action : ""); ?>
	
	<div class="modal-body field-loginform-password required">	
        <?php if($model->scenario == 'changePassword') { ?>
		<div class="form-group">
			 <label class="col-sm-4 control-label" for="Old Password">Old Password</label>
			<div class="col-sm-8">
			 		<?php echo $form->field($model, 'old_password')->passwordInput(['placeholder' => USER_CHANGEPASSWORD_OLDPASSWORD])->label(false); ?>
			</div>
		</div>
		<?php } ?>
		<div class="form-group">
		  <label class="col-sm-4 control-label" for="New Password">New Password</label>
		  <div class="col-sm-8">
			  <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => USER_CHANGEPASSWORD_PASSWORD])->label(false); ?></div>
		</div>
		
		<div class="form-group">
		  <label class="col-sm-4 control-label" for="Confirm Password">Confirm Password</label>
		  <div class="col-sm-8">
			  <?php echo $form->field($model, 'confirm_password')->passwordInput(['placeholder' => USER_CHANGEPASSWORD_CONFIRMPASSWORD])->label(false); ?></div>
		</div>
		</div>
		
		<div class="clearfix"></div>
       <div class="modal-footer margin_top10">		
          <div class="col-lg-12 text-right"><?php echo Html::submitButton('Change Password', ['class' => 'btn btn-primary logi_submit']); ?></div>
      </div>		  
	<?php ActiveForm::end(); ?>	
	 </div>
    
	<div class="clearfix"></div>
</div>
</div>