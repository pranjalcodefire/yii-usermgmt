<?php

namespace vendor\codefire\cfusermgmt\models;

use Yii;
use yii\db\ActiveRecord;
/* User Role is totally different concept from User Groups, There should be no confusion regarding user roles with user groups */
class UserRole extends \yii\db\ActiveRecord{
    
    public static function tableName(){
        return '{{%auth_assignment}}';
    }
    
}





