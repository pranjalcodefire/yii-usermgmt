<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>
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
                        <li><a href="<?php echo Url::to(['/usermgmt/user/communications']); ?>" title='Email / SMS Preference'>SMS / Email</a></li>
                        <li><a href="<?php echo Url::to(['/usermgmt/user/change-password']); ?>" title='Change Password'>Change Password</a></li>
                    </ul>
                </li>  
                <li class=""><a href="#">Loan <span class="arrow">▼</span></a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo Url::to(['/loan/view']); ?>" title='Loans'>Loans</a></li>	
                        <li><a href="<?php echo Url::to(['/transactions/index']); ?>" title='Loans'>Transactions</a></li>	
                        <li><a href="<?php echo Url::to(['/payment/index']); ?>" title='Loans'>Repayments</a></li>		
                    </ul>
                </li> 
                
                <li><a href="<?php echo Url::to(['/request/index']); ?>" title='Profile Change Requests'>Requests</a></li>		
<!--                <li class=""><a href="#">Review <span class="arrow">▼</span></a>
                    <ul class="sub-menu">
                        <li><a href="<?php //echo Url::to(['/reviews/parameter/index']); ?>" title='Manage Parameter'>Parameters</a></li>
                        <li><a href="<?php //echo Url::to(['/reviews/parameter/options']); ?>" title='Manage Parameter Values'>Parameter Values</a></li>
                        <li><a href="<?php //echo Url::to(['/reviews/review/index']); ?>" title='Manage Reviews'>Reviews</a></li>					
                    </ul>
                </li>  -->
                <li><a href="<?php echo Url::to(['/message/inbox']); ?>" title='Messages'>Messages</a></li>		
                <li class=""><a href="#">Settings<span class="arrow">▼</span></a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo Url::to(['/contents/content/index']); ?>" title='Content Management System'>CMS</a></li>
                        <li><a href="<?php echo Url::to(['/usermgmt/setting/index']); ?>" title='Configuration'>Configuration</a></li>
                        <li><a href="<?php echo Yii::$app->urlManager->createUrl(['/usermgmt/user/clear-cache']); ?>" title='Flush Cache(Frontend)'>Flush Cache (F)</a></li>			 
                    </ul>
                </li> 
                <li><a href="<?php echo Url::to(['/usermgmt/user/pending-tasks']); ?>" title='Pending Tasks'>Pending Tasks</a></li>		
                <li><?php echo yii\helpers\Html::a("Sign Out", \yii\helpers\Url::to(['/usermgmt/user/logout'])); ?></li>
            </ul>
        </nav>
    </div>
    <div style="clear:both"></div>
</div>
</div>
