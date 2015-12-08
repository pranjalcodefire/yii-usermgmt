<?php
namespace vendor\codefire\cfusermgmt\views\helpers;
//
use vendor\codefire\cfusermgmt\models\User;
use Yii;
use yii\helpers\Html;


class Helper extends \yii\base\Component{

    static function findStateById($id){
        $model = new State;
        $record = $model->findOne($id);
        if(!empty($record)){
            return $record->s_name;
        }
        return NULL;
    }
    
    static function findAllRoles(){
        $model = new \vendor\codefire\cfusermgmt\models\AuthItem();
        $results = $model->find()->select(['name', 'role_alias'])->where(['auth_item.type' => TYPE_ROLE])->orderBy('created_at DESC')->asArray()->all();
        if(empty($results)){
            return null;
        }
        $resultsArr = [];
        foreach($results as $result){
            $resultsArr[$result['name']] = $result['role_alias'];
        }
        return $resultsArr;
    }
    
    static function findCityById($id){
    $model = new City;
        $record = $model->findOne($id);
        if (!empty($record)) {
            return $record->s_name;
        }
        return NULL;
    }

    /**
     * Function to send the SMS 
     * @param array $data :  array of the details
     * @return string : if $data not containg the valid details
     */
	public static function sendsms($data) {
        if(!SEND_SMS) {
            return false;
        }
        if(!empty($data['To']) && !empty($data['Message'])) {
            $url = "http://www.smsgatewaycenter.com/library/send_sms_2.php";
            $To =$data['To'];
            $Message =$data['Message'];
            $postData ='';
            $postData .='UserName=';
            $postData .=SMS_USERNAME;
            $postData .='&Password=';
            $postData .=SMS_PASSWORD;
            $postData .='&Type=';
            $postData .=SMS_TYPE;
            $postData .='&To=';
            $postData .=$To;
            $postData .='&Mask=';
            $postData .=SMS_MASK;
            $postData .='&Message=';
            $postData .=$Message;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
		}else{
            return "please provide user mob no. and message";
		}
	}
    
    static function findGenderOptions(){
		$model = new User();
		return $model->findGenderOptions();
	}

	static function findMaritalStatusOptions(){
		$model = new User();
		return $model->findMaritalStatusOptions();
	}

	static function findCities(){
		$model = new City();
		return $model->findCities();
	}

    static function findMyLoans(){
        $model = new \common\models\Loan();
        return $model->findMyLoans();
    }

    static function findStates(){
		$model = new State();
		return $model->findStates();
	}
   
    static function findUserRole($userId = NULL){
        if(empty($userId)){
            $userId = \Yii::$app->user->getId();
        }
        $userRoleData = \vendor\codefire\cfusermgmt\models\AuthAssignment::find()->where(["user_id"=>$userId])->one();
        return (!empty($userRoleData) ? $userRoleData->item_name : NULL);
    }

	static function findIndustryOptions($opted = NULL){
		$options = [
                "1" => "Sales, Marketing and Advertising", 
                "2" => "Banking and Financial services",
                "3" => "E commerce/ IT/ ITeS",
                "4" => "Oil and gas",
                "5" => "Manufacturing",
                "6" => "Trading",
                "7" => "Hospitality and allied services",
                "8" => "Healthcare",
                "9" => "Others",
            ];
		if(!empty($opted)){
			return isset($options[$opted]) ? $options[$opted] : "";
		}
		return $options;
	}
    
    static function findProofCategory($opted = NULL){
		$options = ["1" => "Aadhar Card", "2" => "Passport", "3" => "Voter Id"];
		if(!empty($opted)){
			return isset($options[$opted]) ? $options[$opted] : "";
		}
		return $options;
	}
    
    static function findBorrowerTypeOptions($opted = NULL){
		$options = [
                "1" => "Service",
                "2" => "Professional",
                "3" => "Self employed",
                "4" => "Home maker",
                "5" => "Retired",
                "6" => "Others"
            ];
		if(!empty($opted)){
			return isset($options[$opted]) ? $options[$opted] : "";
		}
		return $options;
	}

    static function findBorrowerRatingOptions($opted = NULL){
		$options = unserialize(BORROWER_RATINGS);
		if(!empty($opted) || $opted == '0'){
			return isset($options[$opted]) ? $options[$opted] : "";
		}
		return $options;
	}
    
    static function findBorrowerRatingById($id = NULL){
		$model = new Borrower();
		$detail = $model->findByUserId($id);
        $ratingIndex = $detail->rating;
        return self::findBorrowerRatingOptions($ratingIndex);
    }
    
    static function findAddressBelongsType($opted = NULL){
		$options = ["1" => "Owned", "2" => "Not Owned"];
		if(!empty($opted)){
			return isset($options[$opted]) ? $options[$opted] : "";
		}
		return $options;
	}

	static function findBankNames($opted = NULL){
		$options = ["1" => "ICICI Bank", '2'=>"SBI Bank"];
		if(!empty($opted)){
			return isset($options[$opted]) ? $options[$opted] : "";
		}
		return $options;
	}

	public static function getLoanStatus($status) {
		switch ($status) {
			case ($status == LOAN_OPEN) :
				return "Open State";
				break;
			case ($status == LOAN_CANCELLED) :
				return "Loan Cancelled";
				break;
			case ($status == LOAN_CLOSED) :
				return "Loan Closed";
				break;
			case ($status == LOAN_FUNDED) :
				return "Funded";
				break;
			case ($status == LOAN_ACTIVE) :
				return "Loan Active";
				break;
			default:
				return "Unknown";
				break;
		}
	}

	public static function fundedPercentage($amountNeeded=0,$amountReceived=0) {
		$fundedPercentage=0;
		if($amountReceived==0) return 0;
		elseif ($amountReceived > $amountNeeded) return 100;
		return round(( $amountReceived * 100 )/$amountNeeded,2);
	}
	public static function addOrdinalNumberSuffix($num) {
		if (!in_array(($num % 100),array(11,12,13))){
			switch ($num % 10) {
				// Handle 1st, 2nd, 3rd
				case 1:  return $num.'st';
				case 2:  return $num.'nd';
				case 3:  return $num.'rd';
			}
		}
		return $num.'th';
	}
	/*
	 * function will return the Image source for borrower profile picture
	 */
	public static function getBorrowerProfilePicture($borrowerid=null,$imageName=null) {
		if(!is_null($imageName)){
			return Yii::$app->homeUrl . 'images'.DIRECTORY_SEPARATOR. USER_PROFILE_IMAGES_DIRECTORY . DIRECTORY_SEPARATOR .$imageName;
		} else {
			$borrower=User::find()->select(['img_path'])->where(['id'=>$borrowerid])->one();
			return Yii::$app->homeUrl . 'images'.DIRECTORY_SEPARATOR. USER_PROFILE_IMAGES_DIRECTORY . DIRECTORY_SEPARATOR .$borrower['img_path'];
		}
	}
	static function getTransactionType($txn=null){
		switch ($txn) {
			case ($txn == TXN_ADD_FUNDS) :
				return "Add Funds";
				break;
			case ($txn == TXN_BORROWER_REPAYMENT) :
				return "Borrower Repayments";
				break;
			case ($txn == TXN_LENDER_REPAYMENT) :
				return "Lender Repayments";
				break;
			case ($txn == TXN_LOAN_BIDS) :
				return "Loan Biddings";
				break;
			case ($txn == TXN_WITHDRAW_FUNDS) :
				return "Withdraw Funds";
				break;
			case ($txn == TXN_DISBURSEMENT) :
				return "Disbursement";
				break;
			default:
				return "Unknown";
				break;
		}
	}
	
	public static function isHome(){
    	$controller = Yii::$app->controller;
		$default_controller = Yii::$app->defaultRoute;
		$isHome = (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;
		return $isHome;
    }
    static function findRequestStatus($opted = NULL){
    $options = [REQUEST_PENDING => "Pending", REQUEST_APPROVED => "Approved", REQUEST_REJECTED => "Rejected"];
        if (!empty($opted)) {
            return isset($options[$opted]) ? $options[$opted] : "";
        }
        return $options;
    }

    public static function canAskForUpdateDetails($userId = NULL) {
        return ((!\common\models\Request::find()->where('user_id = :user_id and approved = :pending', [":user_id" => \Yii::$app->user->getId(), ':pending' => REQUEST_PENDING])->count()) 
        && ($userId == Yii::$app->user->getId()));
    }

    static function findRoles($id){
        $model = new \vendor\codefire\cfusermgmt\models\AuthAssignment();
        return $model->findRecords();
    }  
    
    /**
     * 
     * getAdminCharges According to Amount Needed
     * @param float $amount_needed
     * @return integer
     */
    public static function getAdminCharges($amount_needed=0){
		$adminCharges=unserialize(LOAN_ADMIN_CHARGES);
		$charges=$adminCharges[-1];
    	$amount = $amount_needed;
		if($amount <= 10000) {
			$charges = $adminCharges[10000];
		} else if($amount > 10000 && $amount <= 40000) {
			$charges = $adminCharges[40000];
		} else if($amount > 40000 && $amount <= 70000) {
			$charges = $adminCharges[70000];
		} else if($amount > 70000 && $amount <= 100000) {
			$charges = $adminCharges[100000];
		} else {
			$charges = $adminCharges[-1];
		}
		return $charges;
    }
    
    static function getLendersByLoanId($id = NULL){
        $model = new \common\models\Loan();
        return $model->getLendersByLoanId($id);
    }
    
    static function getLoansAll($id = NULL){
        $model = new \common\models\Loan();
        return $model->findRecordsAll($id);
    }
    public static function getInterestRates(){
    	return array("" => "All Interest", 5 => "Upto 5%",
    	 10 => "upto 10%", 20 => "upto 20%",30 => "Upto 30%", 40 => "upto 40%",50=>"upto 50%",60=>"upto 60%",
    	 70 => "upto 70%", 80 => "upto 80%",90=>"upto 90%",100=>"upto 100%");
    }
    public static function getBorrowerRatings(){
   		$borrowerRatings=[];
		$ratings=unserialize(BORROWER_RATINGS);
		foreach ($ratings as $key=>$val){
			$borrowerRatings[$key]=$val;
		}
		return $borrowerRatings;
    }
    public static function getLoanState($state=0) {
    	if($state == LOAN_STATUS_PENDING) {
    		return "Pending";
    	} elseif ($state == LOAN_STATUS_APPROVED) {
    		return "Approved";
    	} elseif ($state == LOAN_STATUS_REJECTED){
    		return "Rejected";
    	} else {
    		return "Pending";
    	}
    }
    public static function getFeaturedView($loanId,$isFeatured=false){
    	if(!$loanId){
    		return '';
    	}
    	if($isFeatured){
    		return Html::a('<span class="glyphicon glyphicon-star"></span>',array('loan/featured','id'=>$loanId,'featured'=>UNFEATURED_LOAN),['data-method'=>'POST','title'=>'Mark Loan as Unfeatured']);
    	} else {
    		return Html::a('<span class="glyphicon glyphicon-star-empty"></span>',array('loan/featured','id'=>$loanId,'featured'=>FEATURED_LOAN),['data-method'=>'POST','title'=>'Mark Loan as Featured']);
    	}
    }

    public static function findCompanyYearRange(){
        $years = []; 
        for($i = date('Y'); $i >= (date('Y') - 100) ; $i--)
            $years[$i] = $i;
        return $years;
    }

    public static function formatAmount($amount=0){
		return number_format($amount, 2, '.', ',');
	}
	public static function getAvailableMaxBorrowAmount(){
			$max=0;
			$type=User::find()->select('type')->where(['id'=>\Yii::$app->user->getId()])->one();
			if($type->type  == REGISTER_AS_INDIVIDUAL ) {
				$max=REGISTER_AS_INDIVIDUAL_MAXLIMIT;
			} elseif($type->type == REGISTER_AS_COMPANY) {
				$max=REGISTER_AS_COMPANY_MAXLIMIT;
			}
			return $max;
	}
    
    public static function getAge($date){
        $date = new \DateTime($date);
        $now = new \DateTime();
        $interval = $now->diff($date);
        return $interval->y . " Years"; 
    }
    
    static function findRoleAlias($roleName = NULL){
        if(empty($roleName)){
            return null;
        }
        $roleAlias = \vendor\codefire\cfusermgmt\models\AuthItem::find()->where(["name"=>$roleName, 'type' => TYPE_ROLE])->one();
        return (!empty($roleAlias) ? $roleAlias->role_alias : NULL);
    }
    
}

