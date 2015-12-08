<?php
namespace vendor\codefire\cfusermgmt\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\Url;

use vendor\codefire\cfusermgmt\models\UserDetail;
use vendor\Linkedin\LinkedIn;
use vendor\Linkedin\OAuthToken;
use frontend\models\Event;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $role
 * @property integer $status
 * @property integer $created
 * @property integer $modified
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    
    #################################### MODEL BASE ####################################
    
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const ROLE_USER = 10;
    
    /*Fields not the part of database fields...declare them public*/
    public $password;        
    public $old_password;
    public $new_password;
    public $confirm_password;
    public $verifyCode;
    public $file;
    public $sendMe;
    public $verify_code;
    public $item_name;

    /**
     * To tell the model which table to use for this model 
     * @return string : the table name with to use for this model (with auto prefix)
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * To specify the behaviors to use for this model
     * @return : behaviors to use for this model 
     */
    public function behaviors() 
    {
        return [
            //TimestampBehavior::className(),
        ];
    }
	

    /**
     * To validate the input fields
     * @return : the validation rules to validate and respective error messages
     */
    public function rules() 
    {
        $useCaptcha = USE_RECAPTCHA ? ['register'] : [];
        return [
            [['first_name', 'last_name','username', 'email', 'password'], 'required', 'message' => USER_FIRSTNAME_REQUIRED],    //default
            ['confirm_password', 'required', 'message' => USER_CONFIRMPASSWORD_REQUIRED],    //default
            ['email', 'email', 'message'=> USER_EMAIL_EMAIL],        //default
            ['email', 'unique', 'targetClass' => '\vendor\codefire\cfusermgmt\models\User', 'message' => USER_EMAIL_UNIQUE, 'on'=>['register', 'editProfile','addUser', 'editUser']],
            ['username', 'unique', 'targetClass' => '\vendor\codefire\cfusermgmt\models\User', 'message' => USER_USERNAME_UNIQUE],
            ['password', 'string', 'min' => 6, 'message'=> USER_PASSWORD_STRING],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=> USER_CONFIRMPASSWORD_COMPARE],  //default
            ['username', 'verifyBannedUsernames'], //for user and admin both
            ['phone_number', 'required', "message" => USER_PHONENUMBER_REQUIRED, 'on'=>['register', 'editProfile']],   
            ['phone_number', 'match', 'pattern' => '/^\d{10}$|^\d{10}$/', 'message' => USER_PHONENUMBER_MATCH, 'on'=>['register', 'editProfile']],
            ['dob', 'required', 'message' => USER_DOB_REQUIRED, 'on'=>'register'],
//          ['accept_tnc', 'compare', 'compareValue' => "1", 'message' => USER_ACCEPTTNC_COMPARE, 'on'=>'register'],
            ['industry', 'required', 'message' => USER_INDUSTRY_REQUIRED, 'on'=>'register'],
            [['img_path'], 'file', 'extensions' => 'png, jpg, jpeg','skipOnEmpty' => true, 'on' => ['editProfile']], //
            [['img_path'], 'file', 'extensions' => 'png, jpg, jpeg','skipOnEmpty' => true, 'on' => ['register']],
            [['old_password', 'password', 'confirm_password'], 'required', 'on'=>'changePassword'],         //for user and admin both
            ['old_password', 'verifyOldPassword', 'on'=>'changePassword'],                                  //for user and admin both
            [['first_name', 'last_name', 'username', 'email'], 'required', 'on'=>'editProfile'],     
            [['password', 'confirm_password'], 'required', 'on'=>'changeUserPassword'],         //for admin only
            
            
            
            ######Default values to go 
            ['status', 'default', 'value' =>DEFAULT_STATUS_FOR_NEW_USER, 'on'=>['register', 'addUser']],      
            ['by_admin', 'default', 'value' =>BY_ADMIN, 'on'=>'addUser'],      
            ['verifyCode', 'captcha', 'on'=>$useCaptcha],
            
            ["email", 'required', 'on' =>'sendMail'],
            ['email', 'sendVerifyEmailValidate', 
//                'targetClass' => '\vendor\codefire\cfusermgmt\models\User',
//                'filter' => ['email_verified' => NOT_VERIFIED],
//                'message' => USER_EMAIL_MESSAGE,
                'on' =>'sendMail'
            ],
            ['sendMe', 'required', 'message' => USER_SENDME_REQUIRED, 'on' =>'sendMail'],
            
            ["verify_code", 'required', 'message' => USER_VERIFYCODE_REQUIRED, 'on' =>'smsVerify'],
            ["verify_code", 'validateSmsToken', 'on' =>'smsVerify'],
            
//            ['status', 'in', 'range' => [ACTIVE, DELETED]],
//            ['role', 'default', 'value' => self::ROLE_USER],
//            ['role', 'in', 'range' => [self::ROLE_USER]],
        ];
    }
    
    
    /**
     * To define scenarios for this model (for validation purposes)
     * @return : different scenarios to use for this model
     */
    public function scenarios() 
    {
        $register = USE_RECAPTCHA 
            ? ['first_name', 'last_name', 'username', 'password', 'confirm_password', 'email', 'status', "phone_number", "dob", 'accept_tnc', 'industry', 'type', 'img_path', 'verifyCode'] 
            : ['first_name', 'last_name', 'username', 'password', 'confirm_password', 'email', 'status', "phone_number", "dob", 'accept_tnc', 'industry', 'type', 'img_path'];
        return [
            'login'=>['email', 'password'],
            'register'=>$register,
            'changePassword'=>['old_password', 'password', 'confirm_password'],
            'editProfile'=>['first_name', 'last_name','username', 'email', 'phone_number', 'dob', 'about', 'img_path', 'gender'],
            #########Scenario for admin
            'addUser'=>['first_name', 'last_name', 'username', 'password', 'confirm_password', 'email', 'status', 'by_admin'],
            'editUser'=>['first_name', 'last_name', 'username', 'email', 'status'],
            'statusChange'=>['status'],
            'approve'=>['approved'],
            'changeUserPassword'=>['password', 'confirm_password'],
            'emailVerification'=>['email_verified'],
            
            #######Password reset
            'resetPassword'=>['email'],
            'resetPass'=>['password'],
            
            #######Send Mail
            'sendMail' => ["email", 'sendMe'],
            'smsVerify' => ['verify_code'],
            
            
        ];
        
    }
    
    /*
     * To Associate this model to another model(here associating with "UserDetail" Model)
     * @return : the relation with model
     */
    public function getUserDetail() 
    {
        return $this->hasOne(UserDetail::className(), ['user_id'=>'id']);
    }
    
    /*
     * To Associate this model to another model(here associating with "UserRole" Model)
     * @return : the relation with model
     */
    public function getUserRole() 
    {
        return $this->hasMany(UserRole::className(), ['user_id'=>'id']);
    }
    #################################### MODEL BASE ####################################
    
    
    
    
    
    #################################### STATIC ARRAY VALUES FUNCTIONS ####################################
    
    /**
     * To get all the gender options
     * @return array : array of all the gender options
     */
    public static function findGenderOptions()
    {
        return [
            'M'=>'Male',
            'F'=>'Female',
            'O'=>'Any Other',
        ];
    }
    
    /**
     * To get all the marital status options
     * @return array : array of marital status options
     */
    public static function findMaritalStatusOptions()
    {
        return [
            'M'=>'Married',
            'U'=>'Unmarried',
            'D'=>'Divorced',
            'W'=>'Widowed',
        ];
    }
    
    
    #################################### USER FUNCTIONS ####################################
    
    
    /**
     * To get the identity of the user WITH STATUS
     * @param type $id : the user having this id
     * @return type record Object(User object)
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()->onCondition('username = :username or email = :email', [':username'=>$username, ':email'=>$username])->one();//'status' => ACTIVE
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Validate SMS verification code
     */
    public function validateSmsToken($attribute, $params){
        $record = $this->find()->select(['sms_token'])->where(["id" => $this->id])->one();
        if(empty($record->sms_token) || ($record->sms_token != $this->$attribute)){
            $this->addError($attribute, "Wrong SMS verification code");
        }
        
    }
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
    /**
     * To set the password for the registering user
     * @param type string password
     * @return type string password_hash (generated)
     */
    public static function setNewPassword($password = NULL)
    {
        return Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * To set the auth_key for registering user
     * @return type string auth_key(generated)
     */
    public static function generateNewAuthKey()
    {
        return Yii::$app->security->generateRandomString();
    }
    
    /**
     * To calculate the attribute label names
     * @return : the attribute label names (tranlatable in other language)
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'email' => Yii::t('app', 'Email'),
            'username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'fb_id' => Yii::t('app', 'Fb ID'),
            'fb_access_token' => Yii::t('app', 'Fb Access Token'),
            'twt_id' => Yii::t('app', 'Twt ID'),
            'twt_access_token' => Yii::t('app', 'Twt Access Token'),
            'twt_access_secret' => Yii::t('app', 'Twt Access Secret'),
            'ldn_id' => Yii::t('app', 'Ldn ID'),
            'status' => Yii::t('app', 'Status'),
            'email_verified' => Yii::t('app', 'Email Verified'),
            'last_login' => Yii::t('app', 'Last Login'),
            'by_admin' => Yii::t('app', 'By Admin'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }
    
    /**
     * To validate the old password
     * @param string : $attribute attribute name
     * @param type : $params other params
     * adds the error in error's array if not match with old password(actual)
     */
    public function verifyOldPassword($attribute, $params)
    {
        $user = $this->findIdentity(Yii::$app->user->getId());
        if($user!=null){
          if(!$user->validatePassword($this->$attribute)){
            $this->addError($attribute, "Incorrect current password");
          }
        }
        
    }
   
    /**
     * To not allow the banned usernames 
     * @param string : $attribute attribute name
     * @param type : $params other params
     * adds the error in error's array if banned username requested to set
     */
    public function verifyBannedUsernames($attribute, $params)
    {
        $bannedUsername = explode(',', BANNED_USERNAMES);
        if(in_array(strtolower(trim($this->$attribute)), array_map('strtolower', array_map('trim', $bannedUsername)))){
            $this->addError($attribute, "This username is reserved and can not be opted");
        }
    }
    
    /**
     * To not allow the banned usernames 
     * @param string : $attribute attribute name
     * @param type : $params other params
     * adds the error in error's array if banned username requested to set
     */
//    public function phoneNumber($attribute, $params)
//    {
//        if(!empty($this->$attribute)){
//            $number = str_replace("-", "", $this->$attribute);
//            $number = str_replace("_", "", $number);
//            if(strlen($number) < 10){
//                $this->addError($attribute, "Please enter a 10 digit Mobile Number");
//            }
//        }
//    }
    
    public static function sendMail($templateFile, $details, $to, $subject){
        return \Yii::$app->mailer->compose($templateFile, ['details' => $details])
                    ->setFrom([EMAIL_FROM_ADDRESS => EMAIL_FROM_NAME]) //\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'
                    ->setTo($to)
                    ->setSubject($subject) //\Yii::$app->name
                    ->send();
    }
	
	public static function CheckPermission($event){
        $method = $event->action->actionMethod;
		$methodName = substr($method, 6);
		$objectName = $event->action->controller->id;
        $class = explode('\\', $objectName);
        $module = $event->action->controller->module->id;
        $modulePos = explode('app-', $module);
        if(!empty($modulePos[0])){
            $dbAction = $modulePos[0] .':'.  $objectName .':'.$methodName;
        }else{
            $dbAction = $modulePos[1].':'.$objectName.':'.$methodName;
        }
        
        $status = false;
		$user = AuthAssignment::find()->onCondition(['user_id'=>Yii::$app->user->getId()])->andWhere(['IN', 'item_name', [SUPERADMIN_ROLE_ALIAS, ADMIN_ROLE_ALIAS, ADMIN_ROLE_NAME]])->one();
               // Here Yii did not get the user id for guest user....so that we need to fetch actions from database allowed to perform by guest and need to check for that array
        $guestAllowedOnly = AuthItemChild::find()->where(['parent' => GUEST_ROLE_ALIAS])->asArray()->all();
        $guestAllowedArr = [];
        foreach($guestAllowedOnly as $guestAllowed){
            $guestAllowedArr[] = $guestAllowed['child'];
        }
        if(!in_array('usermgmt:user:Login', $guestAllowedArr)){
            $guestAllowedArr[] = 'usermgmt:user:Login';
        }
        if((!empty($user) && in_array($user->item_name, array(SUPERADMIN_ROLE_ALIAS, ADMIN_ROLE_ALIAS, ADMIN_ROLE_NAME))) && (!CHECK_PERMISSIONS_FOR_ADMIN || Yii::$app->user->can($dbAction))){
            $status = true;
        }elseif(
            !USE_PERMISSIONS_FOR_USERS 
            || in_array(
                $dbAction, 
//                array(
//                    'contents:content:Info', 
//                    'frontend:loan:BrowseAll', 
//                    'frontend:contact:Index', 
//                    'frontend:page:Faq', 
//                    'frontend:site:Index', 
//                    'frontend:events:ProcessEvents',
//                    'frontend:cron:LoanExpiry',
//                    'frontend:payment:Initiate',
//                    'frontend:generic:Checkout',
//                    'frontend:payment:GetHash',
//                    'usermgmt:user:Login', 
//                    'usermgmt:user:Logout', 
//                    'usermgmt:user:Register', 
//                    'usermgmt:user:VerifyEmail', 
//                    'usermgmt:user:SendVerifyEmail', 
//                    'usermgmt:user:RequestPasswordReset', 
//                    'usermgmt:user:ResetPassword', 
//                    'usermgmt:user:View', 
//                    'usermgmt:user:PermissionDenied'
//                    )
                $guestAllowedArr
                ) 
            || Yii::$app->user->can($dbAction)
           ) { 
            $status = true;
        }
        return $status;
	}
    
    /**
     * Function to create unique username
     */
    public function generateUsername(){
        if($username = $this->first_name){
            $i = 1;
            do{
                $username = strtolower($this->first_name.$i);
                $i++;
            }while(User::find()->where(["username" => $username])->one());
            return $username;
        }
    }
    
    #################################### USER FUNCTIONS ####################################
    
    public function findUsers($where_clause = null){
        $users = $this->find()->innerJoinWith("userRole")->where ($where_clause);
        $pagination = new \yii\data\Pagination(['defaultPageSize'=>DEFAULT_PAGE_SIZE, 'totalCount'=> $users->count()]);
        $users = $users->offset($pagination->offset)->limit($pagination->limit)->orderBy('created desc')->all();
        return array($users, $pagination);
    }
            
    public function register(){
        if(NEW_REGISTRATION_IS_ALLOWED){
            $modelDetail = new UserDetail;
            $model = new User;
            $model->scenario = 'addUser';
            
           if($model->load(Yii::$app->request->post())){
                $file = \yii\web\UploadedFile::getInstance($model, 'img_path');
                if(isset($file) && !empty($file)){
                    $filePath = USER_DIRECTORY_PATH.DS.USER_PROFILE_IMAGES_DIRECTORY.DS;
                    $model->img_path = Yii::$app->custom->uploadFile($file, $filePath);
                }
				;
                if($model->validate()){
                    $model->auth_key = User::generateNewAuthKey();
                    $model->password_hash = User::setNewPassword($model->password);
                    
                    if(isset($model->phone_number)){ $model->phone_number = str_replace("-", "", $model->phone_number); }
                    if(isset($model->dob)){ $model->dob = date("Y-m-d", strtotime($model->dob)); }
                   
                    if($model->save(false)){ 
                        
                        /** Associated Model linking ***/
                        $modelDetail->user_id = $model->id;
                        $model->link("userDetail", $modelDetail);
                       						
                        $userGroups = RoleAndPermission::find()->onCondition(['type'=>'1'])->asArray()->all();
                        $roleNames = [];
                        foreach($userGroups as $userGroup){
                            $roleNames[] = $userGroup['name'];
                        }
                        if(in_array(DEFAULT_ROLE_NAME, $roleNames)){
                            $userRole = new AuthAssignment;
                            $userRole->item_name = DEFAULT_ROLE_NAME;
                            $userRole->user_id = $model->id;
                        }    
                        $model->link("userRole", $userRole);
                        /** Associated Model linking ***/
                      
                        if($model->save(false)){
                            if(!SEND_REGISTRATION_MAIL){ 
                                User::sendMail('welcome-email', $model, $model->email, 'Welcome to - '.SITE_NAME);
                            }
                            Yii::$app->session->setFlash('success', 'Please verify your Email. A verification link has been sent to your Email Address.');
                            return array('redirect' => true, 'url' => Url::to(['/usermgmt/user/login']));
                        }else{
                            Yii::$app->session->setFlash('success', 'Your registration was not successful.');
                            return array('redirect' => true, 'url' => Yii::$app->homeUrl);
                        }
                    }    
                }
            }
            return array('render' => "register", 'model' => $model);
        }else{
            Yii::$app->session->setFlash('danger', 'Currently new registrations are not allowed by administrator. Please try later.');
            return array('redirect' => true, 'url' => Yii::$app->homeUrl);
        }  
    }
    
    
    
    /**
     * Function to validate send-verify-email
     */
    public function sendVerifyEmailValidate($attribute, $params){
        $record = self::find()->where(['email' => $this->$attribute])->one();
        if(empty($record)){
            $this->addError($attribute, USER_EMAIL_DOES_NOT_EXIST);   
        }elseif(!empty($record->email_verified)){
            $this->addError($attribute, USER_EMAIL_MESSAGE);   
        }
    }
    
   
    
}
