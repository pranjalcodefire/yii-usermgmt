<?php

namespace vendor\codefire\cfusermgmt\models;

use Yii;
use yii\db\ActiveRecord;

class Setting extends \yii\db\ActiveRecord{
    
    public static function tableName(){
        return '{{%settings}}';
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
    
    
    public static function getAllSettings(){
        $results = Setting::find();
        /*$pagination = new Pagination(['defaultPageSize'=>DEFAULT_PAGE_SIZE, 'totalCount'=> $results->count()]);*/
        $settings = [];
        $results = $results->orderBy('id')->asArray()->all();
        foreach($results as $result){
            $settings[$result['name']]['value'] = $result['value'];
        }
        return $settings;
    }
    
    
    
}





