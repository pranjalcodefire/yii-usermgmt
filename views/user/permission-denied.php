<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Access Denied';
?>
<div class="container top-bottom_padding">
    <div class="col-md-6 col-sm-8 col-sm-10 login_box">
        <div class="modal-header title_bottomMargin0">      
            <h4 class="modal-title"><?php echo $this->title; ?></h4>
        </div>	
        <div class="modal-body">	
            <div class="form-group">
                <div class="col-sm-12">
                    You are not authorized to access this page (Access denied by administrator)
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
</div>

