<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;

$this->title = 'Edit Role';
?>
<div class="container top-bottom_padding">
<div class="col-md-6 col-sm-8 col-sm-10 login_box">
	<div class="modal-header title_bottomMargin0">      
        <h4 class="modal-title"><?php echo $this->title; ?>		
		  <?php echo Html::a('View Role', Url::to(['role-and-permission/view', 'name' => $model->name]), ['class' => 'btn btn-danger pull-right', 'style' => 'margin-top:-2px;']); ?>
		</h4>
    </div>
	<div class="modal-body">	
    <?php $form = ActiveForm::begin(); ?>
    <div class="form-group">
	    <label class="col-sm-4 control-label" for="Name">Name</label>
		<div class="col-sm-8">
            <?php echo $form->field($model, 'name')->textInput(['placeholder' => ROLEANDPERMISSION_SAVE_NAME, 'disabled' => (($model->name == SUPERADMIN_ROLE_ALIAS) ? true : false)])->label(false); ?>
		</div>
	</div>
    <div class="form-group">
	    <label class="col-sm-4 control-label" for="role_alias">Role Alias</label>
		<div class="col-sm-8">
            <?php echo $form->field($model, 'role_alias')->textInput(['placeholder'=>ROLEANDPERMISSION_SAVE_ALIASNAME])->label(false); ?>
            <em>This will appear on screen for the role</em>
        </div>
	</div>
    <div class="form-group">
	    <label class="col-sm-4 control-label" for="allow_registration">Allow Registration</label>
		<div class="col-sm-8">
		 <?php echo $form->field($model, 'allow_registration')->checkbox(['label' => false]);?>
		</div>
	</div>
	<div class="clearfix"></div>
	</div>
	
	<div class="clearfix"></div>
	<div class="panel-footer  margin_top10">
		<div class="row">
		    <div class="col-lg-12 text-center"><?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary']); ?></div>
		</div>
	</div>
    <?php ActiveForm::end(); ?>
</div>
</div>
</div>
