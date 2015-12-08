<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Dashboard';
?>
<style>
    a.thumbnail:hover, a.thumbnail:focus, a.thumbnail.active{
        background-color: rgb(232, 233, 237);
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4><?php echo $this->title; ?></h4>
        </div>
    </div>
    <div class="row">
        <div class=" col-md-2 col-sm-3 col-xs-6">
            <a href="<?php echo Url::to(['/usermgmt/user/my-profile']); ?>" class="thumbnail" title='My Profile'>
                <div class="caption text-center">
                    <h5>My Profile</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6">
            <a href="<?php echo Url::to(['/usermgmt/user/edit-profile']); ?>" class="thumbnail" title='Edit Profile'>
                <div class="caption text-center">
                    <h5>Edit Profile</h5>
                </div>
            </a>
        </div>
        <div class=" col-md-2 col-sm-3 col-xs-6">
            <a href="<?php echo Url::to(['/usermgmt/user/change-password']); ?>" class="thumbnail" title='Change Password'>
                <div class="caption text-center">
                    <h5>Change Password</h5>
                </div>
            </a>
        </div>
    </div>
</div>