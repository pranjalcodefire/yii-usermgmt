<?php

namespace vendor\codefire\cfusermgmt\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use yii\helpers\Url;
use vendor\codefire\cfusermgmt\models\AuthItemChild;
use vendor\codefire\cfusermgmt\models\AuthItem;

/******Models we goona use in this controller*****/
use vendor\codefire\cfusermgmt\models\RoleAndPermission;


class RoleAndPermissionController extends Controller{
    
    #################################### CONTROLLER BASE ####################################
    
    var $searchFields = array (
			'index' => array(
				'RoleAndPermission' => array(
					'name'=> array(
						'type' => 'text',
						'label' => 'Name'
					),
					'role_alias' => array(
						'type' => 'text',
						'label' => 'Role Alias (Screen Name)'
					),
					
					'allow_registration' => array(
						'type' => 'select',
						'label' => 'Registration Allowed',
						'options' => array(''=>'Select', '0'=>'No', '1'=>'Yes')
					)
				)
			)
		);
    
    #################################### CONTROLLER BASE ####################################
    
    
    
    
    #################################### ADMIN FUNCTIONS ####################################
    
    /*
     * To show all the records (Role) listing - (Case type = 1)
     * return the view of listing of records (Users)
     */
    public function actionIndex($count = DEFAULT_PAGE_SIZE)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->controller->module->layout = false;
        }
        $where_clause = null;
        if(isset(\Yii::$app->controller->searchFields)) {
            $argument_data = null;
            if(Yii::$app->request->isAjax) {
                $argument_data = $_REQUEST;
            }
            $where_clause = \vendor\codefire\cfusermgmt\models\Behavior\searchBehavior::search_behavior($argument_data);
        }
        $query = RoleAndPermission::find()->onCondition(['type' => TYPE_ROLE])->where($where_clause);  //Type 1 is for Role (Type 2 is for permission);
        $activeDataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $count,
            ],
            'sort' => [
                'defaultOrder' => ['name' => SORT_DESC],
                'attributes' => ['created_at', 'name', 'role_alias', 'allow_registration'],
            ],
        ]);
        $models = $activeDataProvider->getModels();
        return $this->render('index', ['activeDataProvider' => $activeDataProvider, 'models' => $models]);
    }
    
    /**
     * To add a record into the model (User)
     * @return : view of add record (User) form
     */
    public function actionSave()
    {
        if(!Yii::$app->user->isGuest){
            $model = new RoleAndPermission;
            $model->scenario = 'saveRole';
            if($model->load(Yii::$app->request->post())){
                $model->type = 1; // type 1 is for Role
                if($model->validate()){
                    $model->save(false) ? Yii::$app->session->setFlash('success', 'Role details has been saved successfully', true) : Yii::$app->session->setFlash('danger', 'Role details was NOT saved successfully', true);
                    return $this->redirect(['/usermgmt/role-and-permission/index']);
                }    
            }
            return $this->render('save', ['model'=>$model]);
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be logged in to perform any private operation', true);
            $this->redirect(Url::to(['/usermgmt/user/login']));
        }    
    }
    
    /**
     * To see the particular record information (User Profile)
     * @param type $id : record id to fetch the particular user Profile Detail (user_id)
     * @return : view of record information (User Profile)
     */
    public function actionView($name = NULL)
    {
        if(!Yii::$app->user->isGuest){
            $model = RoleAndPermission::findOne($name);
            if(isset($model) && !empty($model)){
                return $this->render('view', ['model'=>$model]);
            }else{
                Yii::$app->session->setFlash("danger", 'Invalid role or role does not exist', true);
                return $this->redirect(Url::to(['/usermgmt/role-and-permission/index']));
            }
        }
    }
    
    /**
     * To edit the record information (Role)
     * @param long $id : To get the particular user's id
     * @return : the view of edit User form
     */
    public function actionEdit($name = NULL)
    {
        if(!Yii::$app->user->isGuest){
            $model = RoleAndPermission::findOne($name);
            if(isset($model) && !empty($model)){
                $model->scenario = 'saveRole';
                $roleName = $model->name;
                if($model->load(Yii::$app->request->post()) && $model->validate()){
                    // Not to update role name when the role name is of superadmin (SUPERADMIN_ROLE_ALIAS)
                    if($roleName == SUPERADMIN_ROLE_ALIAS){
                        $model->name = $roleName;
                    }
                    if(RoleAndPermission::updateAll(['name'=>$model->name, 'role_alias'=>$model->role_alias, 'allow_registration'=>$model->allow_registration, 'updated_at' => time()], "name = '$name'")){
                        Yii::$app->session->setFlash("success", 'Role has been updated successfully', true);
                    }
                    return $this->redirect(Url::to(['/usermgmt/role-and-permission/index']));
                }
                else{
                    return $this->render('edit', ['model'=>$model]);
                }
            }else{
                Yii::$app->session->setFlash("danger", 'Invalid Role', true);
                return $this->redirect(Url::to(['/usermgmt/user/index']));
            }
        }else{
            Yii::$app->session->setFlash("danger", 'You have to be looged in to perform any private operation', true);
            return $this->redirect(Url::to(['/usermgmt/user/index']));
        }
    }
    
    #################################### ADMIN FUNCTIONS ####################################
    
    
    
    
    
    #################################### AJAX FUNCTIONS ####################################
    
    public function actionDeleteRole()
    {
        $name = $_POST['id'];
        if(Yii::$app->request->isAjax){
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if(strtolower($name) == strtolower(SUPER_ADMIN_ROLE_NAME)){
                return ['status'=>'blocked', 'message'=>'This role can never be deleted as it is SuperAdmin('.SUPER_ADMIN_ROLE_NAME.')'];
            }
            if(isset($_POST['confirmed']) && !empty($_POST['confirmed'])){
                $model = AuthItem::findOne($name);
                if(isset($model) && !empty($model)){
                    return ($model->deleteAll(['name'=>$model->name])) ? ['status'=>'success', 'recordDeleted'=>DELETED] : ['status'=>'failure'];
                }
            }else{
                $modelChildren = AuthItemChild::getAllChildren($name);
                $modelParent = AuthItemChild::getAllParent($name);
                if((count($modelParent) !=0) || (count($modelChildren)  != 0)){
                    return ['status'=>'staged', 'childOrParent'=>true, 'children'=>  count($modelChildren), 'parent'=>  count($modelParent)];
                }else{
                    return ['status'=>'staged', 'childOrParent'=>false];
                }
            }
                
        }
    }
    
    
    #################################### AJAX FUNCTIONS ####################################
    
    
}
    

