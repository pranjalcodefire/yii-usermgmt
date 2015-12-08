<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;


$this->title = $options['legend'];
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<div class="searchForm">
<?php
$search_fields = \Yii::$app->controller->searchFields;
$form = ActiveForm::begin(['options' => ['id' => 'search_form','action'=>'']]);
if(isset($search_fields[Yii::$app->controller->action->id])) {
}
$modelName = key($search_fields[Yii::$app->controller->action->id]);
foreach ($search_fields[Yii::$app->controller->action->id][$modelName] as $fieldName => $fields) {
	$fieldOptions['autoComplete'] = "off";
	$fieldOptions['class'] = "form-control input-sm";
	$fieldOptions['required'] = false;
	$fieldObject = $form->field($model, $fieldName);
    
    if(isset($_SESSION['generic_search'][$modelName][$fieldName])) {
        $model->$fieldName = $_SESSION['generic_search'][$modelName][$fieldName];
    }
    
    if($fields['type'] == "text") {
		$fieldObject->input($fields['type']);
    } else if($fields['type'] == "select") {
        if(isset($fields['selector'])){
        	$opts = ['' => 'Please Select'];
            $mod = $fields['model'];
            $optObj = new $mod;
            $optFun = $fields['selector'];
            $opts = $opts + $optObj->$optFun();
        }else{
            $opts = $fields['options'];
        }
        $fieldObject->dropDownList ($opts);
    }
	$search_level = $fields['label'];
	$fieldObject->label(false);
    
    //'value'=>(isset($_SESSION['generic_search'][$key1][$key2])?$_SESSION['generic_search'][$key1][$key2]:"")])->label($model->getAttributeLabel($value2['label'])
	echo "<div style='display:inline-block' class='col-sm-3 col-xs-12 search-frm-topspc'>";
	echo "<div>".$search_level."</div>";
	echo "<div>".$fieldObject."</div>";
	echo "<div style='clear:both'></div>";
	echo "</div>";
}
echo "<div class='search_submit col-sm-12' style='text-align:center;'>";
echo "<input type='button' class='btn btn-primary' value='Search' onclick='search_generic()' >";
echo "<input type='button' class='btn btn-primary' style='margin-left:20px;' value='Reset' onclick='reset_filter()' >";
echo "</div>";
echo "<div style='clear:both'></div>";
ActiveForm::end();
?>
</div>

<script>
function search_generic()
{
	var data = $('#search_form').serialize();
	$.ajax({
			'url' : $('#search_form').attr('action'),
			type: 'post',
			data : data,
			success : function(data){
				$('#<?php echo $options['updateDivId']?>').html('');
				$('#<?php echo $options['updateDivId']?>').html(data);
			}
	});
}

function reset_filter()
{
	window.location.href = "<?php echo Yii::$app->request->baseUrl; ?>/usermgmt/user/reset-filter?href="+window.location.href;
}
</script>

	  

