<?php 
    use yii\helpers\Html;
?>
<fieldset class="mar_bottom22">
    <div class="edit_pro_h">Profile Details</div>
    <div class="row">
        <div class="col-md-6 col-sm-3 col-xs-6"><?php echo Html::label("Username"); ?></div>
        <div class="col-md-6 col-sm-9 col-xs-6"><?php echo (!empty($model->username)) ? (Html::encode($model->username)) : NOT_FOUND_TEXT; ?></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-3 col-xs-6"><?php echo Html::label("Email"); ?></div>
        <div class="col-md-6 col-sm-9 col-xs-6"><?php echo (!empty($model->email)) ? (Html::encode($model->email)) : NOT_FOUND_TEXT; ?></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-3 col-xs-6"><?php echo Html::label("First name"); ?></div>
        <div class="col-md-6 col-sm-9 col-xs-6"><?php echo (!empty($model->first_name)) ? (Html::encode($model->first_name)) : NOT_FOUND_TEXT; ?></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-3 col-xs-6"><?php echo Html::label("Last name"); ?></div>
        <div class="col-md-6 col-sm-9 col-xs-6"><?php echo (!empty($model->last_name)) ? (Html::encode($model->last_name)) : NOT_FOUND_TEXT; ?></div>
    </div>
    <div class="row">
        <?php $label = 'Date of Birth';?>
        <div class="col-md-6 col-sm-3 col-xs-6"><?php echo Html::label($label); ?></div>
        <div class="col-md-6 col-sm-9 col-xs-6"><?php echo (!empty($model->dob)) ? date(DATE_FORMAT, strtotime(Html::encode($model->dob))) : NOT_FOUND_TEXT; ?></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-3 col-xs-6"><?php echo Html::label("Mobile Number"); ?></div>
        <div class="col-md-6 col-sm-9 col-xs-6"><?php echo (!empty($model->phone_number)) ? (Html::encode($model->phone_number)) : NOT_FOUND_TEXT; ?></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-3 col-xs-6"><?php echo Html::label("Joined"); ?></div>
        <div class="col-md-6 col-sm-9 col-xs-6"><?php echo (!empty($model->created)) ? date(DATE_FORMAT, strtotime(Html::encode($model->created))) : NOT_FOUND_TEXT; ?></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-3 col-xs-6"><?php echo Html::label("Status"); ?></div>
        <div class="col-md-6 col-sm-9 col-xs-6"><?php echo (!empty($model->status)) ? ((Html::encode($model->status) == ACTIVE) ? 'Active' : 'Inactive') : NOT_FOUND_TEXT; ?></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-3 col-xs-6"><?php echo Html::label("About"); ?></div>
        <div class="col-md-6 col-sm-9 col-xs-6"><?php echo (!empty($model->about)) ? (Html::encode($model->about)) : NOT_FOUND_TEXT; ?></div>
    </div>
</fieldset>
