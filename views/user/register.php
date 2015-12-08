<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
?>
<div class="container-fluid rgistr_top border_top_botom">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 our_rgi_pnl">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h1 class="panel-title panheding">Sign Up</h1>
                    </div>
                    <div class="modal-body">   
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label class="control-label col-xs-4 rgi_txt_lbl" for="firstName"><?php echo Html::label("First Name"); ?></label>
                                    <div class="col-xs-8">
                                        <?php echo $form->field($model, 'first_name')->textInput([ 'placeholder' => USER_REGISTERASLENDER_FIRSTNAME])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label class="control-label col-xs-4 rgi_txt_lbl" for="lastName"><?php echo Html::label("Last Name"); ?></label>
                                    <div class="col-xs-8">
                                        <?php echo $form->field($model, 'last_name')->textInput([ 'placeholder' => USER_REGISTERASLENDER_LAST_NAME])->label(false); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label class="control-label col-xs-4 rgi_txt_lbl" for="username"><?php echo Html::label('Username'); ?></label>
                                    <div class="col-xs-8">
                                        <?php echo $form->field($model, 'username')->textInput([ 'placeholder' => USER_REGISTERASLENDER_USERNAME])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label class="control-label col-xs-4 rgi_txt_lbl" for="email"><?php echo Html::label('Email'); ?></label>
                                    <div class="col-xs-8">
                                        <?php echo $form->field($model, 'email')->textInput(['placeholder' => USER_REGISTERASLENDER_EMAIL])->label(false); ?>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label class="control-label col-xs-4 rgi_txt_lbl" for="inputPassword"><?php echo Html::label("Password"); ?></label>
                                    <div class="col-xs-8">
                                        <?php echo $form->field($model, 'password')->passwordInput(["placeholder" => USER_REGISTERASLENDER_PASSWORD])->label(false); ?>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label class="control-label col-xs-4 rgi_txt_lbl" for="confirmPassword"><?php echo Html::label('Confirm Password'); ?></label>
                                    <div class="col-xs-8">
                                        <?php echo $form->field($model, 'confirm_password')->passwordInput(["placeholder" => USER_REGISTERASLENDER_CONFIRMPASSWORD])->label(false); ?>
                                    </div>
                                </div></div>
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <div class="col-xs-offset-4 col-xs-8">
                                        <label class="checkbox-inline termMargin-none">
                                            <?php echo $form->field($model, 'accept_tnc')->checkbox(["label" => 'I agree with the <a href="javascript:void(0)" onclick="open_term_conditions()">Terms & Conditions</a>'])->label(false); ?>
                                        </label>
                                    </div>
                                </div>
                                <?php if (USE_RECAPTCHA) { ?>
                                    <div class="form-group col-lg-6 col-md-6">
                                        <div class="col-xs-offset-4 col-xs-8">
                                            <label class="checkbox-inline">
                                                <?php echo Html::label("Captcha"); ?>
                                                <?php echo $form->field($model, 'verifyCode')->widget(Captcha::className(), ['template' => '<div class="row"><div class="col-lg-4">{image}</div><div class="col-lg-6">{input}</div></div>']); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                          </form>               
                    </div>
                    <div class="panel-footer">
                        <div class="row">
                            <div class="rgistr_btn_centr">
                                <?php echo Html::submitButton('Join Now', ['class' => 'btn btn-primary']); ?>
                               
                              
                            </div>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
</div>
