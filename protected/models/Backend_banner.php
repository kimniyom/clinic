<?php
class Backend_banner{
	function get_banner(){
		$query = "SELECT * FROM banner ORDER BY banner_id asc";
		$result = Yii::app()->db->createCommand($query)->queryAll();
		return $result;
	}

	function get_banner_by_id($banner_id = null){
		$query = "SELECT * FROM banner WHERE banner_id = '$banner_id'";
		$result = Yii::app()->db->createCommand($query)->queryRow();
		return $result;
	}
}