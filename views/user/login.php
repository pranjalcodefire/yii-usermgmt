<?php

use yii \helpers\Url;
use yii\helpers\

Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<!--new code--->
<div class="container top-bottom_padding">
<!--today code for login page Start HERE--->
<div class="row">
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <div class="col-md-6 col-sm-8 col-sm-10 login_box">
	<div class="modal-header">      
        <h4 class="modal-title">Login</h4>
      </div>
		<div class="modal-body">
		<div class="form-group">
			  <label class="col-sm-3 control-label" for="inputEmail3">Email</label>
				  <div class="col-sm-9">
					<?php echo $form->field($model, 'username')->textInput(['placeholder' => $model->getAttributeLabel('username')])->label(false); ?>
				  </div>
			  </div>
			<div class="form-group">
			  <label class="col-sm-3 control-label" for="inputPassword3">Password</label>
			  <div class="col-sm-9">
				  <?php echo $form->field($model, 'password')->passwordInput(['placeholder' => $model->getAttributeLabel('password')])->label(false); ?></div>
			</div>
			<div class="form-group">
			 <label class="col-sm-3 hideClass">&nbsp;</label>
			  <div class="col-sm-9 loginNo_margin">
			  <div class="row">
			   <div class="col-sm-6">
				<div class="checkbox homeLogin">				 
					   <?php echo $form->field($model, 'rememberMe')->checkbox() ?>
				</div>
				  </div>
				 <div class="col-sm-6">
				<?php echo Html::a('Forgot Password?', Url::to([ 'user/request-password-reset']), ['class' => 'pull-right']); ?>
			  </div>			
			</div>
		</div>
		</div>
		</div>
		
		<div class="clearfix"></div>
		<div class="modal-footer margin_top10">
		 <div class="row">    
            <div class="col-sm-6 col-xs-6 text-left verifyEmail">
                <?php echo Html::a('Verify Email?', Url::to([ '/usermgmt/user/send-verify-email']), ['class' => 'pull-right']); ?>                
             </div>
        <div class="col-sm-6 col-xs-6"> <?php echo Html::submitButton('Login', [ 'class' => 'btn btn-primary  logi_submit', 'name' => 'login-button']) ?></div>
        </div>
	   </div>
		
	  </div>
	   </div>
			
    <?php ActiveForm::end();  ?>
</div>
