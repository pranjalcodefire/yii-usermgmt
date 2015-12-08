<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace vendor\codefire\cfusermgmt;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\helpers\Url;
use yii\web\View;
use yii\web\ForbiddenHttpException;


class Module extends \yii\base\Module implements BootstrapInterface {
    public $controllerNamespace = 'vendor\codefire\cfusermgmt\controllers';
	

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
    }

    
    /**
     * @inheritdoc
     */
    public function bootstrap($app) {
        $app->getUrlManager()->addRules([
            $this->id => $this->id,
            $this->id . '/<controller:[\w\-]+>/<action:[\w\-]+>' => $this->id . '/<controller>/<action>',
        ], false);

		include_once 'config/constants.php';
    }

    /**
     * @inheritdoc
     */
    /*public function beforeAction($action) {
    
	}*/

}
