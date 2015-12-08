<?php
namespace vendor\codefire\cfusermgmt\helper;
use Yii;

class SearchHelper {
	public static function searchForm($that, $model, $options) {
		$output = $that->render('@cfusermgmtView/shared/search_form', array('model' => $model, 'options' => $options), array('plugin' => 'Usermgmt'));
		return $output;
	}
}
