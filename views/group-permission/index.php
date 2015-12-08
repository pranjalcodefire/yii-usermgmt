<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Update Permission';
?>
<div class="container">
<div class="radius_box">
    <div class="row">
        <div class="col-md-12">
		 <h2 class="dasbordTitle"><?php echo $this->title; ?></h2>
        </div>
    <?php echo Html::beginForm($action = '', $method = 'post', $options = []); ?>

    <div class="row">
        <div class="col-md-2"><label>Select Role</label></div>
        <div class="col-md-4">
            <?php
            echo Html::dropDownList('permission', $selection = null, $usersRole, $options = ['style' => 'padding: 5px; width: 200px; margin-top: 9px;', 'id' => 'userRoleParent', 'url' => Url::to(['group-permission/get-child-role'])]);
            ?>
        </div>
        <div class="col-md-2"><h4>Filter by Mode</h4></div>
        <div class="col-md-4">
            <?php
            $controllerMode = array(0 => 'Select Mode', 'backend' => 'backend', 'frontend' => 'frontend', 'vendor\codefire\cfusermgmt' => 'cfusermgmt');
            echo Html::dropDownList('mode_name', $selection = null, $controllerMode, $options = ['style' => 'padding: 5px; width: 200px; margin-top: 9px;', 'id' => 'allControllerMode']);
            ?>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-2"><h4>Select Children</h4></div>
        <div class="col-md-4">
            <?php
            unset($usersRole[0]);
            echo Html::dropDownList('permission_child', $selection = null, $usersRole, $options = ['style' => 'padding: 5px; width: 200px; margin-top: 9px;', 'multiple' => 'multiple', 'id' => 'userRoleChild', 'url' => Url::to(['group-permission/get-role-permission'])]);
            ?>
        </div>
        <div class="col-md-2"><h4>Filter by Controller</h4></div>
        <div class="col-md-4">
            <?php
            $allController = array();
            $allController[0] = 'Select Controller';
            if ($allAuthItem) {
                foreach ($allAuthItem as $key => $value) {
                    $name = explode(":", $value['name']);
                    if ($name[0] == 'cfusermgmt') {
                        $allController[$name[0] . ':' . $name[2]] = $name[0] . ' ' . $name[2] . ' controller';
                    } else {
                        $allController[$name[1]] = $name[1] . ' controller';
                    }
                }
            }
            echo Html::dropDownList('controller_name', $selection = null, $allController, $options = ['style' => 'padding: 5px; width: 200px; margin-top: 9px;', 'id' => 'allControllerFilter']);
            ?>
        </div>
    </div>
  <div class="padding5">
   <div class="col-sm-12">
    <?php echo Html::submitButton('Save Permission', ['class' => 'btn btn-success pull-right']); ?>
    <table class="table table-hover table-bordered" id="permissionSectionBody">
        <thead>
            <tr>
                <th>Controller </th>
                <th>Action</th>
                <th><?php echo Html::checkbox('select_all', false, ['id' => 'select_all']) ?> Permissions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($allAuthItem) {
				//ECHO "<pre>";
			//PRINT_R($allAuthItem);exit;
                foreach ($allAuthItem as $key => $value) {
                    $name = explode(":", $value['name']);
					
                    ?>
                    <tr>
                        <?php if ($name[0] == 'vendor\codefire\cfusermgmt') { ?>
                            <td><?php echo 'cfusermgmt- ' . $name[1] ?></td>
                            <td><?php echo $name[2]; ?></td>
                        <?php } else { ?>
                            <td><?php echo $name[0] . ' - ' . $name[1]; ?></td>
                            <td><?php echo $name[2]; ?></td>
                        <?php } ?>
                        <td><?php echo Html::checkbox($value['name'], false, ['class' => 'select_me']); ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
	<div class="col-sm-12 text-center" style="margin-bottom:20px;">
      <?php echo Html::submitButton('Save Permission', ['class' => 'btn btn-primary']); ?>
	</div>
    <?php echo Html::endForm(); ?>
</div>
</div>
</div>
</div>
</div>