<?php
class Backend_logo{
	function get_logo(){
		$query = "SELECT * FROM logo ORDER BY id asc";
		$result = Yii::app()->db->createCommand($query)->queryAll();
		return $result;
	}

	function get_logo_by_id($id = null){
		$query = "SELECT * FROM logo WHERE id = '$id'";
		$result = Yii::app()->db->createCommand($query)->queryRow();
		return $result;
	}
}