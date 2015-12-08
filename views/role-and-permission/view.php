<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;
use common\models\User;

$this->title = 'Role Details';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container top-bottom_padding">
<div class="col-md-6 col-sm-8 col-sm-10 login_box">
	<div class="modal-header title_bottomMargin0">      
        <h4 class="modal-title"><?php echo $this->title; ?>	
		  <?php echo Html::a('Edit Role', Url::to(['role-and-permission/edit', 'name' => $model->name]), ['class' => 'btn btn-danger pull-right', 'style' => 'margin-top:-2px;']); ?>
		</h4>
    </div>
	<div class="modal-body">
		<div class="form-group">
			<div class="col-sm-6 control-label text-right">Name<?php //echo Html::label(Html::encode($model->getAttributeLabel('name'))); ?></div>
			<div class="col-sm-6 control-label">
			  <?php echo (!empty($model->name)) ? (Html::encode($model->name)) : NOT_FOUND_TEXT; ?> 
			</div>
		</div> 
		<br>
        <div class="form-group">
			<div class="col-sm-6 control-label text-right">Role Alias<?php //echo Html::label(Html::encode($model->getAttributeLabel('name'))); ?></div>
			<div class="col-sm-6 control-label">
			  <?php echo (!empty($model->role_alias)) ? (Html::encode($model->role_alias)) : NOT_FOUND_TEXT; ?> 
			</div>
		</div> 
		<br>
        <div class="form-group">
			<div class="col-sm-6 control-label text-right">Registration Allowed<?php //echo Html::label(Html::encode($model->getAttributeLabel('name'))); ?></div>
			<div class="col-sm-6 control-label">
			  <?php echo (!empty($model->allow_registration)) ? 'Yes' : 'No'; ?> 
			</div>
		</div> 
		<br>
		<div class="form-group">
			<div class="col-sm-6 control-label text-right"> Created<?php //echo Html::label(Html::encode($model->getAttributeLabel('Created'))); ?></div>
			<div class="col-sm-6  control-label">
			 <?php echo (!empty($model->created_at)) ? date(DATE_FORMAT, strtotime(Html::encode($model->created_at))) : NOT_FOUND_TEXT; ?>
			</div>
		</div> 
		<br>
		<div class="clearfix"></div>
   </div>
</div>
</div>