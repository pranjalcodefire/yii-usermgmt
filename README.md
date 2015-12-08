Requirments:
* Yii 2 with advanced application template
* Init your application for development mode
* Php 5.4+
* MySql 5.6+

Steps To install the 'cfusermgmt' plugin:
-----------------------------------------------------------------------------------------
1. Create folder "codefire/cfusermgmt" in vendor folder
2. Extract into cfusermgmt folder (Give permission, init application)
3. add in application's frontend/web/index.php 
require(__DIR__ . '/../../vendor/codefire/cfusermgmt/config/main.php'),
before
require(__DIR__ . '/../config/main-local.php');   // JUST BEFORE THIS LINE


add after $application = new yii\web\Application($config);
require(__DIR__ . '/../../vendor/codefire/cfusermgmt/config/constants.php');

4.  - Delete common/model/User.php
    - Remove user component from application's frontend/config.php
    
5. create htaccess in frontend/web    
	Source code should be:
		<IfModule mod_rewrite.c>
			Options -MultiViews
			RewriteEngine On
			#RewriteBase /path/to/app
			RewriteCond %{REQUEST_FILENAME} !-f
			RewriteRule ^ index.php [L]
		</IfModule>

		Order allow,deny
		allow from all

6. Change SITE_URL to your Current URL on "vendor/codefire/cfusermgmt/config/main.php"
'@SITE_URL' => "Your Url Goes Here"
Like: 
'@SITE_URL' => "http://localhost/plugin_yii"

NOTES:
-----------------------------
* make sure you have import database db.sql file
* Admin credentials (codefire/111111)
Useful Url example:
* FrontEnd Url (http://localhost/BaseFolderName/advanced/frontend/web/usermgmt/user/login)
* BackEnd Url (http://localhost/BaseFolderName/advanced/backend/web/usermgmt/user/login)


You can also install Using composer:

	composer require codefire/cfusermgmt





















        
