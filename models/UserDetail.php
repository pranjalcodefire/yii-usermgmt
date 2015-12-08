<?php

namespace vendor\codefire\cfusermgmt\models;

use Yii;
use yii\db\ActiveRecord;

class UserDetail extends \yii\db\ActiveRecord{
    
    public static function tableName(){
        return '{{%user_details}}';
    }
    
    public function rules(){
        return [
            [['cellphone', 'gender'], 'required', 'on'=>'editProfile'],
        ];
    }
    
    public function scenarios() {
        return [
            'default'=> ['bday', 'marital_status', 'location', 'web_page', 'gender', 'cellphone'],
            'editProfile'=> ['bday', 'marital_status', 'location', 'web_page', 'gender', 'cellphone'],
            
            'register'=> ['user_id'],   //For Guest User registration
            
            
            'addUser'=>['user_id'],     //For Admin User registration
            'editUser'=>['bday', 'marital_status', 'location', 'web_page', 'gender', 'cellphone'],     //For Admin User registration
        ];
    }
    
    
    
    
}





