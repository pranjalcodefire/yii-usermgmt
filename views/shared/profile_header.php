<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="row">
    <div class="profiletopBox">
        <div class="col-md-2 col-sm-4 col-xs-4 profileImageDiv">
            <div class="profile_wrapper img-thumbnail">
                <a href="javascript:(void())" >
                    <?php Yii::$app->custom->showImage(USER_PROFILE_IMAGES_DIRECTORY, $model->img_path); ?>
                </a>
                <div class="change_profileImg">
                    <div class="left" >
                        <i class="fa fa-camera"></i>
                    </div>
                    <div class="right" >
                        <p class="rg_pro_txt">Change Photo</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-7 right_textDiv"><h3><strong><?php echo ($model->id == Yii::$app->user->getId()) ? 'Welcome ' : '' ;?> <?php echo (!empty($model->first_name)) ? (Html::encode($model->first_name) . ' ') : ''; ?></strong></h3>
            <div class="bottom_btn">
                <?php if ($showEditLink) { ?>
                    <?php 
                    if($model->id != Yii::$app->user->getId()){
                        $urlParam = ['/usermgmt/user/edit', 'id' => $model->id];
                    }else{
                        $urlParam = ['/usermgmt/user/edit-profile'];
                    }
                    echo Html::a('Edit Profile', Url::to($urlParam), ['class' => 'btn btn-primary']); ?>
                <?php } ?>
                <?php if ($showViewLink) { ?>
                    <?php 
                    if($model->id != Yii::$app->user->getId()){
                        $urlParam = ['/usermgmt/user/view', 'id' => $model->id];
                    }else{
                        $urlParam = ['/usermgmt/user/my-profile'];
                    }
                    echo Html::a('View Profile', Url::to($urlParam), ['class' => 'btn btn-primary']); ?>
                <?php } ?>
                <?php if (!empty($allowUpdateByAdmin))  { 
                        $text = ($model->approved == ACTIVE) ? 'Dis-Approve' : 'Approve';
                    ?>
                    <?php echo Html::a($text, Url::to(['/usermgmt/user/approve', 'id' => $model->id]), ['class' => 'btn btn-success']); ?>
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>
