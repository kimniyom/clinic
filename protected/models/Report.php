<?php

class Report {
	
	function getproduct($branch = null) {
		$sql = "SELECT p.*
                FROM product p 
                WHERE p.status = 0 AND p.branch = '$branch' ";
		
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
	
	function getproductinputAll($year = null, $month = null, $product_id = null) {
		$sql = "SELECT SUBSTR(i.date_input,6,2) AS MONTHS,COUNT(*) AS TOTAL
                FROM items i
                WHERE LEFT(i.date_input,4) = '$year' 
                AND SUBSTR(i.date_input,6,2) = '$month' AND i.product_id = '$product_id' ";
		$rs = Yii::app()->db->createCommand($sql)->queryRow();
		return $rs['TOTAL'];
	}
	
	function getproductsell($year = null, $month = null, $product_id = null) {
		$sql = "SELECT SUBSTR(s.date_sell,6,2) AS MONTHS,COUNT(*) AS TOTAL
                FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode
                WHERE LEFT(s.date_sell,4) = '$year' 
                AND SUBSTR(s.date_sell,6,2) = '$month'
                AND i.product_id = '$product_id' AND i.`status` = '1' ";
		$rs = Yii::app()->db->createCommand($sql)->queryRow();
		return $rs['TOTAL'];
	}
	
	function getproductstockAll($year = null, $month = null, $product_id = null) {
		$monthNows = date("m");
		if (strlen($monthNows) < 1) {
			$monthNow = "0" . ($monthNows + 1);
		}
		else {
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
	
	function Getcostproduct($year = null, $branch = null) {
		if (!empty($branch)) {
			$WHERE = " AND p.branch = '$branch'";
		}
		else {
			$WHERE = "";
		}
		$sql = "SELECT SUM(Q.itemstotal) AS itemstotal,SUM(Q.pricrtotal) AS pricetotal
                FROM(
                    SELECT p.product_name,i.product_id,COUNT(*) as itemstotal,p.costs,(p.costs * COUNT(*)) as pricrtotal
                    FROM items i INNER JOIN product p ON i.product_id = p.product_id
                    WHERE LEFT(i.date_input,4) = '$year' $WHERE
                    GROUP BY i.product_id
                ) Q ";
		return Yii::app()->db->createCommand($sql)->queryRow();
	}
	
	function Gettotalsell($year = null, $branch = null) {
		if (!empty($branch)) {
			$WHERE = " AND p.branch = '$branch'";
		}
		else {
			$WHERE = "";
		}
		$sql = "SELECT SUM(Q.totalitem) AS totalitems,SUM(Q.totalprice) AS totalprice
                FROM(
                    SELECT p.product_name,i.product_id,p.product_price,COUNT(*) AS totalitem,(p.product_price * COUNT(*)) AS totalprice
                    FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode 
                    INNER JOIN product p ON i.product_id = p.product_id
                    WHERE LEFT(s.date_sell,4) = '$year' $WHERE
                    GROUP BY i.product_id
                ) Q  ";
		return Yii::app()->db->createCommand($sql)->queryRow();
	}
	
	//ข	้อมูลการซื้อสินค้ารายไตรมาส
	    function GetcostproductPeriod($year = null, $branch = null, $period = null) {
		if (!empty($branch)) {
			$WHERE = " AND p.branch = '$branch'";
		}
		else {
			$WHERE = "";
		}
		
		if ($period == '1') {
			$PERIODS = " BETWEEN '01' AND '03' ";
		}
		else if ($period == '2') {
			$PERIODS = " BETWEEN '04' AND '06' ";
		}
		else if ($period == '3') {
			$PERIODS = " BETWEEN '07' AND '09' ";
		}
		else if ($period == '4') {
			$PERIODS = " BETWEEN '10' AND '12' ";
		}
		$sql = "SELECT IFNULL(SUM(Q.itemstotal),0) AS itemstotal,IFNULL(SUM(Q.pricrtotal),0) AS pricrtotal
                FROM(
                    SELECT SUBSTR(i.date_input,5),p.product_name,i.product_id,COUNT(*) as itemstotal,p.costs,(p.costs * COUNT(*)) as pricrtotal
                    FROM items i INNER JOIN product p ON i.product_id = p.product_id
                    WHERE LEFT(i.date_input,4) = '$year' $WHERE AND SUBSTR(i.date_input,6,2) $PERIODS
                GROUP BY i.product_id
                ) Q  ";
		return Yii::app()->db->createCommand($sql)->queryRow();
	}
	
	//ข	้อมูลการขายสินค้ารายไตรมาส
	    function GettotalsellPeriod($year = null, $branch = null, $period = null) {
		if (!empty($branch)) {
			$WHERE = " AND p.branch = '$branch'";
		}
		else {
			$WHERE = "";
		}
		
		if ($period == '1') {
			$PERIODS = " BETWEEN '01' AND '03' ";
		}
		else if ($period == '2') {
			$PERIODS = " BETWEEN '04' AND '06' ";
		}
		else if ($period == '3') {
			$PERIODS = " BETWEEN '07' AND '09' ";
		}
		else if ($period == '4') {
			$PERIODS = " BETWEEN '10' AND '12' ";
		}
		$sql = "SELECT IFNULL(SUM(Q.totalitem),0) AS totalitems,IFNULL(SUM(Q.totalprice),0) AS totalprice
                FROM(
                    SELECT p.product_name,i.product_id,p.product_price,COUNT(*) AS totalitem,(p.product_price * COUNT(*)) AS totalprice
                    FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode 
                    INNER JOIN product p ON i.product_id = p.product_id
                    WHERE LEFT(s.date_sell,4) = '$year' $WHERE AND SUBSTR(s.date_sell,6,2) $PERIODS
                    GROUP BY i.product_id
                ) Q  ";
		return Yii::app()->db->createCommand($sql)->queryRow();
	}
	
	//ต	้นทุนรายเดือน
	    function GetcostproductMonth($year = null, $branch = null) {
		if (!empty($branch)) {
			$WHERE = " AND p.branch = '$branch'";
		}
		else {
			$WHERE = "";
		}
		
		$sql = "SELECT m.id,m.month_th,IFNULL(SUM(Q.pricrtotal),0) AS pricrtotal
                FROM `month` m 
                LEFT JOIN 
                (
                    SELECT SUBSTR(i.date_input,6,2) AS month,p.product_name,i.product_id,COUNT(*) as itemstotal,p.costs,(p.costs * COUNT(*)) as pricrtotal
                    FROM items i INNER JOIN product p ON i.product_id = p.product_id
                    WHERE LEFT(i.date_input,4) = '$year' $WHERE
                    GROUP BY SUBSTR(i.date_input,6,2),p.product_id
                ) Q 
                ON m.id = Q.month
                GROUP BY m.id";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
	
	//ย	อดขายรายเดือน
	    function GettotalsellMonth($year = null, $branch = null) {
		if (!empty($branch)) {
			$WHERE = " AND p.branch = '$branch'";
		}
		else {
			$WHERE = "";
		}
		
		$sql = "SELECT m.id,m.month_th,IFNULL(SUM(Q.totalprice),0) AS totalprice
                FROM `month` m 
                LEFT JOIN
                (
                    SELECT SUBSTR(s.date_sell,6,2) AS month,i.product_id,COUNT(*) AS totalitem,(p.product_price * COUNT(*)) AS totalprice
                    FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode 
                    INNER JOIN product p ON i.product_id = p.product_id
                    WHERE LEFT(s.date_sell,4) = '$year' $WHERE
                    GROUP BY SUBSTR(s.date_sell,6,2),i.product_id
                ) Q 
                ON m.id = Q.month
                GROUP BY m.id ";
		
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
	
	function GetprofitMonth($year = null, $branch = null) {
		if (!empty($branch)) {
			$WHERE = " AND p.branch = '$branch'";
		}
		else {
			$WHERE = "";
		}
		$sql = "SELECT m.id,IFNULL((SUM(selltotal) - SUM(costtotal)),0) AS profit
                FROM month m
                LEFT JOIN
                (
                SELECT SUBSTR(i.date_input,6,2) AS month,(p.costs * COUNT(*)) as costtotal,0 AS selltotal
                    FROM items i INNER JOIN product p ON i.product_id = p.product_id
                    WHERE LEFT(i.date_input,4) = '$year' $WHERE 
                    GROUP BY SUBSTR(i.date_input,6,2),p.product_id
                UNION
                SELECT SUBSTR(s.date_sell,6,2) AS month,0,(p.product_price * COUNT(*)) AS selltotal
                    FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode 
                    INNER JOIN product p ON i.product_id = p.product_id
                    WHERE LEFT(s.date_sell,4) = '$year' $WHERE 
                    GROUP BY SUBSTR(s.date_sell,6,2),i.product_id
                ) Q
                ON m.id = Q.month
                GROUP BY m.id ";
		
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
	
	function ProductSalable($year = null, $branch = null){
		if (!empty($branch)) {
			$WHERE = " AND p.branch = '$branch'";
		}
		else {
			$WHERE = "";
		}
		
		$sql = "SELECT p.product_name,IFNULL(Q.total,0) AS total
                FROM product p 
                LEFT JOIN
                (
                SELECT p.product_id,p.product_name,COUNT(*) AS total
                FROM sell s INNER JOIN items i ON s.itemcode = i.itemcode
                INNER JOIN product p ON i.product_id = p.product_id
                WHERE LEFT(s.date_sell,4) = '$year' $WHERE 
                GROUP BY p.product_id
                ) Q 
                ON p.product_id = Q.product_id
                WHERE 1=1 $WHERE 
                ORDER BY Q.total DESC ";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
	
	function ReportSellproduct($datestart = null,$dateend = null,$branch = null){
		if (!empty($branch)) {
			$WHERE = " AND l.branch = '$branch'";
		}
		else {
			$WHERE = "";
		}
		$sql = "SELECT l.*,e.`name`,e.lname,e.alias
                FROM logsell l INNER JOIN employee e ON l.user_id = e.id
                WHERE l.date_sell BETWEEN '$datestart' AND '$dateend' $WHERE 
                ORDER BY l.date_sell DESC";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
}
