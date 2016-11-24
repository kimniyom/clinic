<?php

class Report {

    function getproduct($branch = null) {
        $sql = "SELECT p.*
                FROM product p 
                WHERE p.status = 0 AND p.branch = '$branch' ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function getproductinputAll($year = null, $month = null,$product_id = null) {
        $sql = "SELECT SUBSTR(i.date_input,6,2) AS MONTHS,COUNT(*) AS TOTAL
                FROM items i
                WHERE LEFT(i.date_input,4) = '$year' 
                AND SUBSTR(i.date_input,6,2) = '$month' AND i.product_id = '$product_id' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['TOTAL'];
    }
    
    function getproductsell($year = null, $month = null,$product_id = null){
        $sql = "SELECT SUBSTR(s.date_sell,6,2) AS MONTHS,COUNT(*) AS TOTAL
                FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode
                WHERE LEFT(s.date_sell,4) = '$year' 
                AND SUBSTR(s.date_sell,6,2) = '$month'
                AND i.product_id = '$product_id' AND i.`status` = '1' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['TOTAL'];
    }
    
    function getproductstockAll($year = null,$month = null,$product_id = null) {
        $monthNows = date("m");
        if(strlen($monthNows) < 1){
            $monthNow = "0".($monthNows + 1);
        } else {
            $monthNow = ($monthNows + 1);
        }
        $sql = "SELECT SUBSTR(i.date_input,6,2) AS MONTHS,COUNT(*) AS TOTAL
                FROM items i
                WHERE LEFT(i.date_input,4) = '$year' 
                    AND SUBSTR(i.date_input,6,2) <= '$month' AND $month < $monthNow
                    AND i.product_id = '$product_id' AND i.`status` = '0'";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['TOTAL'];
    }

}
