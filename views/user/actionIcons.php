<?php

use yii\helpers\Html;
use yii\helpers\Url;

if(isset($online)) { 
    if ($model->user_id != Yii::$app->user->getId()) {
        $statusClass = Html::encode($model->status == ACTIVE) ? 'glyphicon glyphicon-ok' : 'glyphicon glyphicon-ban-circle';
        $status = Html::encode($model->status == ACTIVE) ? 'Inactive' : 'Active';
        echo Html::a('<span class="' . $statusClass . '"></span>', 'javascript:void(0)', ['class' => 'ableToChangeStatus', 'id' => 'ableToChangeStatus' . $model->user_id, 'url' => Url::to([Yii::$app->controller->id . "/status-user"]), 'title' => 'Make this user ' . $status]);
    }
    echo Html::a('<span class="glyphicon glyphicon-off" style="margin-left:5px;"></span>', 'javascript:void(0)', ['class' => 'ableToLogoutUser', 'id' => 'ableToLogoutUser' . $model->ip_address, 'url' => Url::to([Yii::$app->controller->id . "/logout-user"]), 'title' => 'Logout this user']);
}else{
        if (!in_array($model->userRole[0]->item_name, array(SUPERADMIN_ROLE_ALIAS, ADMIN_ROLE_ALIAS))) {
        $statusClass = Html::encode($model->status == ACTIVE) ? 'glyphicon glyphicon-ok' : 'glyphicon glyphicon-ban-circle';
        $status = Html::encode($model->status == ACTIVE) ? 'Inactive' : 'Active';
        echo Html::a('<span class="' . $statusClass . '"></span>', 'javascript:ableToChangeStatus(' . $model->id . ')', ['id' => 'ableToChangeStatus' . $model->id, 'url' => Url::to([Yii::$app->controller->id . "/status"]), 'title' => 'Make this user ' . $status]);
    }
    echo Html::a('<span class="glyphicon glyphicon-file"></span>', Url::to(['user/view', 'id' => $model->id]), ['title' => 'View User Profile', 'data-pjax' => 0]); 
    echo Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['user/edit', 'id' => $model->id]), ['title' => 'Edit User Details', 'data-pjax' => 0]); 
    //echo Html::a('<span class="glyphicon glyphicon-remove-circle"></span>', 'javascript:void(0)', ['title' => 'Delete this User', 'class' => 'ableToDelete', 'id' => 'ableToDelete' . $model->id, 'url' => Url::to([Yii::$app->controller->id . "/delete"])]);         
    if (EMAIL_VERIFICATION && Html::encode($model->email_verified) == NOT_VERIFIED) {
        echo Html::a('<span class="glyphicon glyphicon-exclamation-sign"></span>', 'javascript:ableToVerifyEmail(' . $model->id . ')', ['title' => 'Verify User Email', 'id' => 'ableToVerifyEmail' . $model->id]);
    }
    echo Html::a('<span class="glyphicon glyphicon-lock"></span>', Url::to(['user/change-user-password', 'id' => $model->id]), ['title' => 'Change User\'s Password', 'data-pjax' => 0]);
}
?>