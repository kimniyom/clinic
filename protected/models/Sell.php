<?php 
class sell {
	function Getlistorder($sell_id = null){
		$sql = "SELECT p.product_name,COUNT(*) AS total,p.product_price
                    FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode
                    INNER JOIN product p ON i.product_id = p.product_id
                    WHERE s.sell_id = '$sell_id' 
                    GROUP BY p.product_id";
		
		$data = Yii::app()->db->createCommand($sql)->queryAll();
        return $data;
	}

    function Detailorder($sell_id = null){
        $sql = "SELECT s.*
                    FROM sell s 
                    WHERE s.sell_id = '$sell_id' LIMIT 1";
		
		$data = Yii::app()->db->createCommand($sql)->queryRow();
        return $data;
    }
}
