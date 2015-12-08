<?php
    $loggedInRole = $modelRole = vendor\codefire\cfusermgmt\views\helpers\Helper::findUserRole($model->id);
    $allowUpdateByAdmin = false;
    if(in_array($loggedInRole, array(ADMIN_ROLE_ALIAS, SUPERADMIN_ROLE_ALIAS))){
        $allowUpdateByAdmin = true;
    }
?>
<div class="container">
    <div class="radius_box">
        <?php $this->title = "My Profile"; ?>
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
                    if(in_array($modelRole, array(SUPERADMIN_ROLE_ALIAS, ADMIN_ROLE_ALIAS, DEFAULT_ROLE_NAME))){
                        echo $this->render("@cfusermgmtView/shared/view_profile_basic_detail", ['model' => $model]);
                    }    
                   
                ?>
                
            </div>
        </div>
    </div>
</div>
