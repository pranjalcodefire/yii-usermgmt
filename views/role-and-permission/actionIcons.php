<?php 
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php echo Html::a('<span class="glyphicon glyphicon-edit"></span>', Url::to(['role-and-permission/edit', 'name' => $model->name]), ['title' => 'Edit Role Name', 'data-pjax' => 0]); ?>
<?php

if (strtolower(SUPER_ADMIN_ROLE_NAME) != strtolower($model->name)) {
    echo Html::a('<span class="glyphicon glyphicon-remove-circle"></span>', 'javascript:ableToDeleteRole("' . $model->name . '")', ['title' => 'Delete this Role', 'id' => 'ableToDeleteRole' . $model->name, 'url' => Url::to([Yii::$app->controller->id . "/delete-role"])]);
}
?>