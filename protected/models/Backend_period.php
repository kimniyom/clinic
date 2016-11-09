<?php

class Backend_period{
	function get_period(){
		$result = Yii::app()->db->createCommand()
			->select('*')
			->from('period')
			->order('id DESC')
			->queryAll();

		return $result;
	}

	function get_period_active(){
		$result = Yii::app()->db->createCommand()
			->select('*')
			->from('period')
			->where('active = 1')
			->queryRow();

		return $result['period'];
	}
}