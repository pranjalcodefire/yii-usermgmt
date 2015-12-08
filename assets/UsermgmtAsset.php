<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace vendor\codefire\cfusermgmt\assets;

use Yii;
use yii\web\AssetBundle;
use yii\helpers\Url;

yii::setAlias('@css_base', "@SITE_URL");

/**
 * Debugger asset bundle
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UsermgmtAsset extends AssetBundle
{
    public $basePath = '@cfusermgmt/web/assets';
    public $baseUrl = '@css_base/vendor/codefire/cfusermgmt/web';
     public $css = [
        'css/jquery-ui.css',
        'css/usermgmt.css',
        'css/style.css',
		'css/menu.css',
        'css/font-awesome.min.css',
        'css/ggl/Roboto_Condensed_400_400italic_700.css',
        'css/ggl/Sans_Pro_400_200.css',
        'css/ggl/Vollkorn_400_400italic_700_700italic.css'
        ];
   public $js = [
    	'js/index.js',
    	'js/bootstrap.js',
        'js/jquery-ui.js',
        'js/usermgmt.js',
        'js/bid.js'
       
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
