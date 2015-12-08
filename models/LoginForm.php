<?php
namespace vendor\codefire\cfusermgmt\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            //['password', 'isNotBlocked'],
            //['password', 'isNotVerified'],
        ];
    }

    public function scenarios() {
        return [
            "loginByEmail" => ["username"],
            "login" => ["username", "password"]
        ];
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || empty($user->password_hash) || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }elseif($user->status == INACTIVE){
                $this->addError($attribute, 'This user is blocked.');
            }elseif($user->email_verified != VERIFIED){
                $userRole = \vendor\codefire\cfusermgmt\views\helpers\Helper::findUserRole($user->id);
                if(!in_array($userRole, array(SUPERADMIN_ROLE_ALIAS, ADMIN_ROLE_ALIAS))){
                    $this->addError($attribute, "Email is not verified yet. Please verify firstly");
                }
            }
        }
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function isNotBlocked($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || $user->status == INACTIVE) {
                $this->addError($attribute, 'This user is blocked.');
            }
        }
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function isNotVerified($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || $user->email_verified != VERIFIED) {
                $this->addError($attribute, "Email is not verified yet. Please verify firstly");
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }
    
    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function loginByEmail()
    {
        $this->scenario = 'loginByEmail';
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
