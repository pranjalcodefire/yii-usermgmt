<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use vendor\codefire\cfusermgmt\assets;
?>
<?php \vendor\codefire\cfusermgmt\assets\UsermgmtAsset::register($this); ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <script>
            var SITE_URL = '<?php echo yii\helpers\Url::home(true); ?>';
        </script>
    </head>
    <body>
        <div id="window_progress" class="ajax-loader" style="align:center"></div>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <nav class="navbar navbar-default navbar-fixed-top">
                <?php include 'header.php'; ?>
            </nav>
            <div class="container">
                <div id="dashboard">
                    <div class="menu-wrap">
                        <nav class="menu">
                            <ul class="clearfix">
                                <li class="current-item"><?php echo Html::a("Dashboard", Url::to(['/usermgmt/user/dashboard'])); ?></li>
                                <li class=""><a href="javascript:void(0)">User <span class="arrow">▼</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo Url::to(['/usermgmt/user/save']); ?>" title='Add User'>Add User</a></li>
                                        <li><a href="<?php echo Url::to(['/usermgmt/user/index']); ?>" title='All Users'>All Users</a></li>	
                                        <li> <a href="<?php echo Url::to(['/usermgmt/user/online']); ?>" title='Online Users'>Online Users</a></li>						
                                    </ul>
                                </li>
                                <li class=""><a href="#">Roles <span class="arrow">▼</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo Url::to(['/usermgmt/role-and-permission/save']); ?>" title='Add Role'>Add Role</a></li>
                                        <li> <a href="<?php echo Url::to(['/usermgmt/role-and-permission/index']); ?>" title='All Roles'>All Roles</a></li>					
                                        <li><a href="<?php echo Url::to(['/usermgmt/group-permission/index']); ?>" title='Permissions'>Permissions</a></li>
                                        <li><a href="<?php echo Url::to(['/usermgmt/group-permission/load']); ?>" title='Load Actions'>Load Actions</a></li>
                                    </ul>
                                </li>
                                <li class=""><a href="#">Profile <span class="arrow">▼</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo Url::to(['/usermgmt/user/my-profile']); ?>" title='My Profile'>My Profile</a></li>
                                        <li><a href="<?php echo Url::to(['/usermgmt/user/edit-profile']); ?>" title='Edit Profile'>Edit Profile</a></li>					
                                        <li><a href="<?php echo Url::to(['/usermgmt/user/change-password']); ?>" title='Change Password'>Change Password</a></li>
                                    </ul>
                                </li>  
                                <li class=""><a href="#">Settings<span class="arrow">▼</span></a>
                                    <ul class="sub-menu">
                                        <li><a href="<?php echo Url::to(['/usermgmt/setting/index']); ?>" title='Configuration'>Configuration</a></li>
                                        <li><a href="<?php echo Yii::$app->urlManager->createUrl(['/usermgmt/user/clear-cache']); ?>" title='Flush Cache(Frontend)'>Flush Cache (F)</a></li>			 
                                    </ul>
                                </li> 
                                <li><?php echo yii\helpers\Html::a("Sign Out", \yii\helpers\Url::to(['/usermgmt/user/logout'])); ?></li>
                            </ul>
                        </nav>
                    </div>
                    <div style="clear:both"></div>
                </div>
            </div>
            <div class="success_message">
                <?php echo $this->render("@cfusermgmtView/shared/flash_msg"); ?>
            </div>
            <?= $content ?>
        </div>
        <?php include 'footer.php'; ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
