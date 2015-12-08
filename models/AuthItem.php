<?php 
namespace vendor\codefire\cfusermgmt\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class AuthItem extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'auth_item';
    }
}

?>