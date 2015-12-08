<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
?>
<!-- headder START------------->
<div class="container-fluid navbar-fixed-top top_hdr">
    <div class="container">
        <div class="row">
            <nav class="navbar" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand logo_tag" href="<?= Yii::$app->homeUrl; ?>"> <img src="<?= Url::to('@SITE_URL') ."/". Url::to('@cfusermgmtWeb'); ?>/images/sit_logo.png"/> </a>
                </div>
                <div class="collapse navbar-collapse pull-right" id="example-navbar-collapse">
			        <ul class="nav navbar-nav navbar-right signup_ul">
						<?php $userRoleAlias = vendor\codefire\cfusermgmt\views\helpers\Helper::findUserRole();
						switch($userRoleAlias){ 
							case ADMIN_ROLE_ALIAS:  ?>
								<li><?php echo yii\helpers\Html::a("Dashboard", \yii\helpers\Url::to(['/usermgmt/user/dashboard'])); ?></li>
								<li><?php echo yii\helpers\Html::a("Sign Out", \yii\helpers\Url::to(['/usermgmt/user/logout'])); ?></li>
								<?php 
								break;
							case DEFAULT_ROLE_NAME: ?>
								<li> 
									<?php echo yii\helpers\Html::a("Hello " . ucwords(Yii::$app->user->identity->first_name) . " <span class='caret'></span>", \yii\helpers\Url::to(['/usermgmt/user/dashboard']), ["aria-expanded" => true, "role" => "button", "aria-haspopup" => true, "data-toggle" => "dropdown", "class" => "dropdown-toggle", "id" => "drop3"]); ?>
									<ul aria-labelledby="drop3" role="menu" class="dropdown-menu my-accountTab">             
										<div class="col-sm-5 leftTabs">                
											<ul>
												<li>
													<?php echo yii\helpers\Html::a("Sign Out", \yii\helpers\Url::to(['/usermgmt/user/logout']), ['class'=>'btn btn-primary']); ?>
												</li>
												<li>
													<a href="">Contact Us</a>
												</li>
											 
											</ul>
										</div>
										<div class="col-sm-7 rightTabs">
											<ul>
												<li><?php echo Html::a("Dashboard", Url::to(['/usermgmt/user/dashboard'])); ?></li>
												<li><?php echo Html::a("My Profile", Url::to(['/usermgmt/user/my-profile'])); ?></li>
												<li><?php echo Html::a("Edit Profile", Url::to(['/usermgmt/user/edit-profile'])); ?></li>
												<li><?php echo Html::a("Change Password", Url::to(['/usermgmt/user/change-password'])); ?></li>
											  
												
											</ul>
										</div>            
									</ul>
								</li>
							<?php 
							break;
						default:  
							?>
							<li>
								<?php echo yii\helpers\Html::a('Login', \yii\helpers\Url::to(['/usermgmt/user/login'])); ?>
							</li>
							<li>
								<?php echo yii\helpers\Html::a("Register", \yii\helpers\Url::to(['/usermgmt/user/register'])); ?>
							</li>
						<?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</div>
