<?php 
    $loggedInRole = $modelRole = vendor\codefire\cfusermgmt\views\helpers\Helper::findUserRole($model->id);
    $allowUpdateByAdmin = $allowUpdateByUser = false;
    if(in_array($loggedInRole, array(ADMIN_ROLE_ALIAS, SUPERADMIN_ROLE_ALIAS))){
        $allowUpdateByAdmin = true;
    }
    if(!$model->approved){
        $allowUpdateByUser = true;
    }
?>
<div class="container">
    <div class="radius_box">
        <?php echo $this->render("@cfusermgmtView/shared/profile_header", [
            'model' => $model, 
            'showEditLink' => false, 
            'showViewLink' => true, 
            'showUpdateRequestLink' => true,
            'allowUpdateByAdmin' => $allowUpdateByAdmin
            ]); ?> 
        <?php $form = yii\bootstrap\ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="row">       
            <div class="col-md-6 r_padding_topp22">
                <?php if(in_array($loggedInRole, array(SUPERADMIN_ROLE_ALIAS, ADMIN_ROLE_ALIAS, DEFAULT_ROLE_NAME))){
                        echo $this->render("@cfusermgmtView/shared/edit_profile_basic_detail", [
                            'model' => $model, 
                            'form'=>$form
                         ]);
                    }
                    
                ?>
            </div>
        </div>
        <div class="row">       
            <div class="col-md-12">
                <p class="mar_bottom22"><?php echo \yii\helpers\Html::submitButton('Submit', ['class' => 'btn btn-primary edit_updt_btn']); ?></p>
            </div>
        </div>
            
        <?php yii\bootstrap\ActiveForm::end(); ?>
    </div>
</div>
