<?php 
class Sell {
	function Getlistorder($sell_id = null){
		$sql = "SELECT p.product_id,c.product_nameclinic AS product_name,SUM(s.number) AS total,p.product_price
                        FROM sell s INNER JOIN clinic_stockproduct p ON s.product_id = p.product_id
                        INNER JOIN center_stockproduct c ON p.product_id = c.product_id
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
