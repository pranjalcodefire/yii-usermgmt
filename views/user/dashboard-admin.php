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
    <div class="radius_box">
    <div class="row">
        <div class="col-md-12">
		   <h2 class="dasbordTitle">Admin <?php echo $this->title; ?></h2>
        </div>
    </div>
    <div class="row">
	  <div class="padding5">
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/user/save']); ?>" class="thumbnail" title='Add User'>
                <div class="caption text-center">
				<i class="fa fa-user-plus icofont"></i>
                        <h5>Add User</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/user/index']); ?>" class="thumbnail" title='All Users'>
                <div class="caption text-center">
				<i class="fa fa-users icofont"></i>
                    <h5>All Users</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/role-and-permission/save']); ?>" class="thumbnail" title='Add Role'>
                <div class="caption text-center">
				<i class="fa fa-plus icofont"></i>
                    <h5>Add Role</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/role-and-permission/index']); ?>" class="thumbnail" title='All Roles'>
                <div class="caption text-center">
				<i class="fa fa-sitemap icofont"></i>

				<h5>All Roles</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/group-permission/index']); ?>" class="thumbnail" title='Permissions'>
                <div class="caption text-center">
				<i class="fa fa-key icofont"></i>
				<h5>Permissions</h5>
                </div>
            </a>

        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/group-permission/load']); ?>" class="thumbnail" title='Load Actions'>
                <div class="caption text-center">
				<i class="fa fa-cloud-upload icofont"></i>
				<h5>Load Actions</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/setting/index']); ?>" class="thumbnail" title='Settings'>
                <div class="caption text-center">
				<i class="fa fa-cog icofont"></i>

                    <h5>Settings</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Yii::$app->urlManager->createUrl(['/usermgmt/user/clear-cache']); ?>" class="thumbnail" title='Flush Cache(Frontend)'>
                <div class="caption text-center">
				<i class="fa fa-trash-o icofont"></i>
				<h5>Flush Cache (F)</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/user/online']); ?>" class="thumbnail" title='Online Users'>
                <div class="caption text-center">
				<i class="fa fa-globe icofont"></i>				
				<h5>Online Users</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/user/my-profile']); ?>" class="thumbnail" title='My Profile'>
                <div class="caption text-center">
				<i class="fa fa-user icofont"></i>
				<h5>My Profile</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/user/edit-profile']); ?>" class="thumbnail" title='Edit Profile'>
                <div class="caption text-center">
				<i class="fa fa-pencil-square-o icofont"></i>
				<h5>Edit Profile</h5>
                </div>
            </a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-6 menu_thumb">
            <a href="<?php echo Url::to(['/usermgmt/user/change-password']); ?>" class="thumbnail" title='Change Password'>
                <div class="caption text-center">
				<i class="fa fa-unlock-alt icofont"></i>
                    <h5>Change Password</h5>
                </div>
            </a>
        </div>
      </div>
     </div>
    </div>
   </div>