<?php
	namespace vendor\codefire\cfusermgmt\models\Behavior;
	use Yii;
	use yii\db\ActiveRecord;
	
	class searchBehavior extends ActiveRecord
	{
		
		public static function search_behavior($data)
		{
			//echo "<pre>";
			//print_r(\Yii::$app);exit;
			if(isset($data['_csrf']))
			{
				unset($data['_csrf']);
			}
			if(isset($data['page']))
			{
				unset($data['page']);
			}
			if(isset($data['per-page']))
			{
				unset($data['per-page']);
			}
			if(isset($data['_pjax']))
			{
				unset($data['_pjax']);
			}
			if(isset($data['sort']))
			{
				unset($data['sort']);
			}
            if(isset($data['count']))
			{
				unset($data['count']);
			}

            
			if(!empty($data))
			{
				$_SESSION['generic_search'] = $data;
			}else {
				if(isset($_SESSION['generic_search']))
				 $data=$_SESSION['generic_search'];
			
			}
			//print_r($_SESSION);
			$i =0;
			$where_condition = "";
			if(empty($data))
			{
				if(!empty($_SESSION['generic_search']))
				$data = $_SESSION['generic_search'];
				else
				$data = "";
			}
			
			if(!empty($data))
			{
				foreach($data as $key => $value)
				{
					$search_field = \Yii::$app->controller->searchFields;
					if($key != str_replace(" ","", ucwords(str_replace("-"," ",Yii::$app->controller->id))))
					{
						break;
					}
					foreach($value as $key1 => $value1)
					{
						
						if($search_field[\Yii::$app->controller->action->id][$key][$key1]['type'] == 'text' && isset($search_field[\Yii::$app->controller->action->id][$key][$key1]['condition']) && $search_field[\Yii::$app->controller->action->id][$key][$key1]['condition'] == "="  && $value1 != "")
						{
							if($i == 0)
							{
								$where_condition[$i] = "and";
							}
							$where_condition[][$key1] = $value1;
							$i++;
						}
						else if(($search_field[\Yii::$app->controller->action->id][$key][$key1]['type'] == 'text' || $search_field[\Yii::$app->controller->action->id][$key][$key1]['type'] == 'select') && $value1 != "")
						{
							if($i == 0)
							{
								$where_condition[$i] = "and";
							}
							$i++;
							$where_condition[$i][] = "like";
							$where_condition[$i][] = $key1;
							$where_condition[$i][] = $value1;
							$i++;
						}
						
					}
					//print_r($search_field);
				}
			}
			//print_r($where_condition);exit;
			return $where_condition;
		}
	}
