<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $this->title = "Verification" ?>
<style>input[type='radio']{margin-left:10px;}</style>
<div class="container top-bottom_padding">
<div class="col-md-6 col-sm-8 col-sm-10 login_box">
	<div class="modal-header title_bottomMargin0">      
        <h4 class="modal-title">Verification</h4>
    </div>
	<div class="modal-body">	
       <?php $form = ActiveForm::begin(); ?>				
	<div class="form-group">
	    <label class="col-sm-3 control-label" for="Email">Email</label>
		<div class="col-sm-8">
	      <?php echo $form->field($model, 'email')->textInput(['placeholder' => USER_SENDVERIFYMAIL_EMAIL])->label(false); ?>
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
</div>