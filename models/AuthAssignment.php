<?php 
namespace vendor\codefire\cfusermgmt\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * AuthAssignment model
 *
 * @property string $item_name
 * @property integer $user_id
 * @property integer $created
 */
 
class AuthAssignment extends ActiveRecord
{
	/**
     * To tell the model which table to use for this model 
     * @return string : the table name with to use for this model (with auto prefix)
     */
    public static function tableName()
    {
        return '{{%auth_assignment}}';
    }
}

?>