<?php
    $modelRole = vendor\codefire\cfusermgmt\views\helpers\Helper::findUserRole($model->id);
    $loggedInRole = vendor\codefire\cfusermgmt\views\helpers\Helper::findUserRole();
    $allowUpdateByAdmin = false;
    if(in_array($loggedInRole, array(ADMIN_ROLE_ALIAS, SUPERADMIN_ROLE_ALIAS))){
        $allowUpdateByAdmin = true;
    }
?>
<div class="container">
    <div class="radius_box">
        <?php $this->title = "User Profile"; ?>
        <?php echo $this->render("@cfusermgmtView/shared/profile_header", [
            'model' => $model, 
            'showEditLink' => true, 
            'showViewLink' => false, 
            'showUpdateRequestLink' => true,
            'modelRole' => $modelRole,
            'allowUpdateByAdmin' => $allowUpdateByAdmin,
            ]); ?> 
        <div class="row">      
            <div class="col-md-6 r_padding_topp22">
                <?php 
                    echo $this->render("@cfusermgmtView/shared/view_profile_basic_detail", ['model' => $model]);
                ?>
                
            </div>
        </div>
    </div>
</div>
