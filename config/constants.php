<?php
    use vendor\codefire\cfusermgmt\models\Setting;
    
    // Yii Level constants starts here - Do not edit if not familier with Yii Rbac
    define('TYPE_ROLE', 1);
    define('TYPE_PERMISSION', 2);
    // Yii Level constants end here
    
    
    
    define('ACTIVE', 1);
    define('INACTIVE', 0);
    define('DELETED', 1);      // For now its used for sending DELETED status (in ajax) , (later can be used to make a record as deleted in database(for now records are actually get deleted from database on request))
    define('VERIFIED', 1);
    define('NOT_VERIFIED', 0);
    define('BY_ADMIN', 1);
    
    //Do not editthis role if not expertise with permission(as this rolename can never be deleted)
    define('SUPER_ADMIN_ROLE_NAME', 'superadmin');
    
    $allSettings=Setting::getAllSettings();

    $timeZoneSet = (isset($allSettings['defaultTimeZone']) && in_array($allSettings['defaultTimeZone'], timezone_identifiers_list())) ? $allSettings['defaultTimeZone']['value'] : 'Asia/Kolkata';
    date_default_timezone_set($timeZoneSet);
    
    if(!defined("DEFAULT_PAGE_SIZE")) {define("DEFAULT_PAGE_SIZE", ((isset($allSettings['default_page_size'])) ? $allSettings['default_page_size']['value'] : 10));}
    if(!defined("NOT_FOUND_TEXT")) {define("NOT_FOUND_TEXT", ((isset($allSettings['not_found_text'])) ? $allSettings['not_found_text']['value'] : '<span style="color:red;">Not Found</span>'));}
    if(!defined("DATE_FORMAT")) {define("DATE_FORMAT", ((isset($allSettings['date_format'])) ? $allSettings['date_format']['value'] : 'F jS, Y'));}
    if(!defined("USER_PROFILE_IMAGES_DIRECTORY")) {define("USER_PROFILE_IMAGES_DIRECTORY", 'user_photos');}
    if(!defined("USER_PROFILE_DEFAULT_IMAGE")) {define("USER_PROFILE_DEFAULT_IMAGE", ((isset($allSettings['user_profile_default_image'])) ? $allSettings['user_profile_default_image']['value'] : 'image-not-found.jpg'));}  // Place this image under the directory USER_PROFILE_IMAGES_DIRECTORY
    if(!defined("APP_IMAGES_DIRECTORY")) {define("APP_IMAGES_DIRECTORY", ((isset($allSettings['app_images_directory'])) ? $allSettings['app_images_directory']['value'] : 'app_images'));}
    if(!defined("AJAX_LOADING_BIG_IMAGE")) {define("AJAX_LOADING_BIG_IMAGE", ((isset($allSettings['ajax_loading_big_image'])) ? $allSettings['ajax_loading_big_image']['value'] : 'circle-loading-animation.gif'));}
    if(!defined("DEFAULT_STATUS_FOR_NEW_USER")) {define("DEFAULT_STATUS_FOR_NEW_USER", ((isset($allSettings['default_status_for_new_user'])) ? $allSettings['default_status_for_new_user']['value'] : ACTIVE));}
    
    
    
    if(!defined("SITE_NAME")) { define("SITE_NAME", ((isset($allSettings['siteName'])) ? $allSettings['siteName']['value'] : 'Yii User Management Plugin')); }
	if(!defined("NEW_REGISTRATION_IS_ALLOWED")) { define("NEW_REGISTRATION_IS_ALLOWED", ((isset($allSettings['siteRegistration'])) ? $allSettings['siteRegistration']['value'] : 1));}
	if(!defined("ALLOW_USERS_TO_DELETE_ACCOUNT")) {define("ALLOW_USERS_TO_DELETE_ACCOUNT", ((isset($allSettings['allowDeleteAccount'])) ? $allSettings['allowDeleteAccount']['value'] : 0));}
	if(!defined("SEND_REGISTRATION_MAIL")) {define("SEND_REGISTRATION_MAIL", ((isset($allSettings['sendRegistrationMail'])) ? $allSettings['sendRegistrationMail']['value'] : 1));}	
	if(!defined("SEND_PASSWORD_CHANGE_MAIL")) {define("SEND_PASSWORD_CHANGE_MAIL", ((isset($allSettings['sendPasswordChangeMail'])) ? $allSettings['sendPasswordChangeMail']['value'] : 1));}	
	if(!defined("EMAIL_VERIFICATION")) {define("EMAIL_VERIFICATION", ((isset($allSettings['emailVerification'])) ? $allSettings['emailVerification']['value'] : 1));}
	if(!defined("EMAIL_FROM_ADDRESS")) {define("EMAIL_FROM_ADDRESS", ((isset($allSettings['emailFromAddress'])) ? $allSettings['emailFromAddress']['value'] : 'example@example.com'));}
	if(!defined("EMAIL_FROM_NAME")) {define("EMAIL_FROM_NAME", ((isset($allSettings['emailFromName'])) ? $allSettings['emailFromName']['value'] : 'User Management Plugin'));}	
	if(!defined("ALLOW_CHANGE_USERNAME")) {define("ALLOW_CHANGE_USERNAME", ((isset($allSettings['allowChangeUsername'])) ? $allSettings['allowChangeUsername']['value'] : 0));}
	if(!defined("BANNED_USERNAMES")) {define("BANNED_USERNAMES", ((isset($allSettings['bannedUsernames'])) ? $allSettings['bannedUsernames']['value'] : ''));}
	if(!defined("USE_RECAPTCHA")) {define("USE_RECAPTCHA", ((isset($allSettings['useRecaptcha'])) ? $allSettings['useRecaptcha']['value'] : 0));}
	if(!defined("PRIVATE_KEY_FROM_RECAPTCHA_GOOGLE")) {define("PRIVATE_KEY_FROM_RECAPTCHA_GOOGLE", ((isset($allSettings['privateKeyFromRecaptcha'])) ? $allSettings['privateKeyFromRecaptcha']['value'] : ''));}
	if(!defined("PUBLIC_KEY_FROM_RECAPTCHA_GOOLE")) {define("PUBLIC_KEY_FROM_RECAPTCHA_GOOLE", ((isset($allSettings['publicKeyFromRecaptcha'])) ? $allSettings['publicKeyFromRecaptcha']['value'] : ''));}
	if(!defined("LOGIN_REDIRECT_URL_FOR_ADMIN")) {define("LOGIN_REDIRECT_URL_FOR_ADMIN", ((isset($allSettings['loginRedirectUrlForAdmin'])) ? $allSettings['loginRedirectUrlForAdmin']['value'] : ''));}
	if(!defined("LOGOUT_REDIRECT_URL_FOR_ADMIN")) {define("LOGOUT_REDIRECT_URL_FOR_ADMIN", ((isset($allSettings['logoutRedirectUrlForAdmin'])) ? $allSettings['logoutRedirectUrlForAdmin']['value'] : ''));}
	if(!defined("LOGIN_REDIRECT_URL_FOR_USER")) {define("LOGIN_REDIRECT_URL_FOR_USER", ((isset($allSettings['loginRedirectUrlForUser'])) ? $allSettings['loginRedirectUrlForUser']['value'] : ''));}
	if(!defined("LOGOUT_REDIRECT_URL_FOR_USER")) {define("LOGOUT_REDIRECT_URL_FOR_USER", ((isset($allSettings['logoutRedirectUrlForUser'])) ? $allSettings['logoutRedirectUrlForUser']['value'] : ''));}
    if(!defined("USE_PERMISSIONS_FOR_USERS")) {define("USE_PERMISSIONS_FOR_USERS", ((isset($allSettings['permissions'])) ? $allSettings['permissions']['value'] : 1));}
	if(!defined("CHECK_PERMISSIONS_FOR_ADMIN")) {define("CHECK_PERMISSIONS_FOR_ADMIN", ((isset($allSettings['adminPermissions'])) ? $allSettings['adminPermissions']['value'] : 0));}
	if(!defined("DEFAULT_ROLE_NAME")) {define("DEFAULT_ROLE_NAME", ((isset($allSettings['defaultRoleName'])) ? $allSettings['defaultRoleName']['value'] : 'user'));}
	if(!defined("ADMIN_ROLE_NAME")) {define("ADMIN_ROLE_NAME", ((isset($allSettings['adminRoleName'])) ? $allSettings['adminRoleName']['value'] : 'admin'));}
	
    
    if(!defined("VIEW_ONLINE_USER_TIME")) {define("VIEW_ONLINE_USER_TIME", ((isset($allSettings['viewOnlineUserTime'])) ? $allSettings['viewOnlineUserTime']['value'] : 30));}
	if(!defined("USE_HTTPS")) {define("USE_HTTPS", ((isset($allSettings['useHttps'])) ? $allSettings['useHttps']['value'] : 0));}
	if(!defined("HTTPS_URLS")) {define("HTTPS_URLS", ((isset($allSettings['httpsUrls'])) ? $allSettings['httpsUrls']['value'] : ''));}
	
    if(!defined("EXT_BASE_PATH")) {define("EXT_BASE_PATH", __DIR__ . '/../');}
    
    
    if(!defined("WWW_ROOT")) {define("WWW_ROOT", $_SERVER['DOCUMENT_ROOT']);}
    if(!defined("DS")) {define("DS", DIRECTORY_SEPARATOR);}
    if(!defined("APP_DIR")) {define("APP_DIR", dirname(dirname(dirname(dirname(__DIR__)))));}
    
    if(!defined("USER_DIRECTORY")) {
        define("USER_DIRECTORY", 'user_folders');
    }
    if(!defined("USER_DIRECTORY_PATH")) {
        define("USER_DIRECTORY_PATH", APP_DIR . DS . USER_DIRECTORY);
    }
    if(!defined("USER_DIRECTORY_URL")) {
        define("USER_DIRECTORY_URL", "@SITE_URL" . "/" . USER_DIRECTORY);
    }
    
    define('SUPERADMIN_ROLE_ALIAS', 'superadmin');
    define('ADMIN_ROLE_ALIAS', 'admin');
    define('GUEST_ROLE_ALIAS', 'guest');
    define('DEFAULT_ROLE_ALIAS', 'user');
    
    define('SUPERADMIN_LAYOUT', 'admin');
    define('ADMIN_LAYOUT', 'admin');
    define('DEFAULT_LAYOUT', 'default');
    
    define('SUPERADMIN_DASHBOARD', 'dashboard-admin');
    define('ADMIN_DASHBOARD', 'dashboard-admin');
    define('DEFAULT_DASHBOARD', 'dashboard-default');
    
	define('LOGIN_URL', 'user/login');
	require "app_messages.php";
