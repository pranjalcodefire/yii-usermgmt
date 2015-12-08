<?php
namespace vendor\codefire\cfusermgmt\components;

use Yii;
use yii\helpers\Html;

class Custom extends \yii\base\Component {
    
    /**
     * Function to upload a file to a given path
     * @param string $file : file instance of yii 
     * @param string $filePath : Actual folder absolute path to save the file
     * @return string $filename : name of the file
     */
    public function uploadFile($file, $filePath){
        if(!is_dir($filePath)){
            mkdir($filePath, 0777, true);
        }
        $fileName = rand(1,1000).time().$file->name;
        if($file->saveAs($filePath.$fileName)){
            return $fileName;
        }
        return NULL;
    }
 
    public function showImage($dir = NULL, $img = NULL, $class='img-rounded', $style="height:150px;width:150px;"){
        if (!empty($img)  && file_exists(USER_DIRECTORY_PATH . DS . $dir . DS . $img)) {
            $imgUrl = USER_DIRECTORY_URL . "/" . $dir . '/' . $img;
        } else {
            $imgUrl = Yii::$app->homeUrl . 'images/' . APP_IMAGES_DIRECTORY . '/' . USER_PROFILE_DEFAULT_IMAGE;
        }
        echo Html::img($imgUrl, ['class' => $class, 'style'=>$style]);
    }
}
