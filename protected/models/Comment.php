<?php
	class Comment{
		function get_comment($product_id = null){
			$query = "SELECT c.*,m.alias,m.images 
				FROM comment c INNER JOIN masuser m ON c.pid = m.pid 
				WHERE product_id = '$product_id' 
				ORDER BY c.id ASC";
			$result = Yii::app()->db->createCommand($query)->queryAll();
			return $result;
		}

		function get_comment_by_id($id = null){
			$query = "SELECT *
				FROM comment
				WHERE id = '$id' ";
			$result = Yii::app()->db->createCommand($query)->queryRow();
			return $result;
		}
	}
?>