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

    function Getcostproduct($year = null, $branch = null) {
        if (!empty($branch)) {
            $WHERE = " AND p.branch = '$branch'";
        } else {
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
        } else {
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
        } else {
            $WHERE = "";
        }

        if ($period == '1') {
            $PERIODS = " BETWEEN '01' AND '03' ";
        } else if ($period == '2') {
            $PERIODS = " BETWEEN '04' AND '06' ";
        } else if ($period == '3') {
            $PERIODS = " BETWEEN '07' AND '09' ";
        } else if ($period == '4') {
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
        } else {
            $WHERE = "";
        }

        if ($period == '1') {
            $PERIODS = " BETWEEN '01' AND '03' ";
        } else if ($period == '2') {
            $PERIODS = " BETWEEN '04' AND '06' ";
        } else if ($period == '3') {
            $PERIODS = " BETWEEN '07' AND '09' ";
        } else if ($period == '4') {
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
        } else {
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
        } else {
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
        } else {
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

    function ProductSalable($year = null, $branch = null) {
        if ($branch != "99") {
            $WHERE = " AND s.branch = '$branch'";
        } else {
            $WHERE = " AND 1=1 ";
        }

        $sql = "SELECT p.product_name,p.product_nameclinic,IFNULL(Q.total,0) AS total
                FROM center_stockproduct p
                LEFT JOIN
                (
	                SELECT p.product_id,p.product_name,SUM(s.number) AS total
	                FROM sell s INNER JOIN center_stockproduct p ON s.product_id = p.product_id
	                WHERE LEFT(s.date_sell,4) = '$year' $WHERE
	                GROUP BY p.product_id
                ) Q
                ON p.product_id = Q.product_id
                ORDER BY Q.total DESC ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function ReportSellproduct($datestart = null, $dateend = null, $branch = null) {
        if ($branch != "99") {
            $WHERE = " AND l.branch = '$branch'";
        } else {
            $WHERE = "";
        }
        $sql = "SELECT l.*,e.`name`,e.lname,e.alias
                FROM logsell l INNER JOIN employee e ON l.user_id = e.id
                WHERE l.date_sell BETWEEN '$datestart' AND '$dateend' $WHERE
                ORDER BY l.date_sell DESC";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function GetIncome($year, $branch) {
        if ($branch != "99") {
            $wheresell = "o.branch = '$branch'";
            $whereservice = "s.branch = '$branch'";
        } else {
            $wheresell = " 1=1 ";
            $whereservice = " 1=1 ";
        }
        $sql = "SELECT IFNULL(SUM(Q.total),0) AS income
                    FROM(
                                SELECT SUM(o.totalfinal) AS total
		FROM logsell o 
		WHERE  $wheresell AND LEFT(o.date_sell,4) = '$year'

                                    UNION

                                    SELECT SUM(s.price_total) AS total
                                    FROM service s 
                                    WHERE $whereservice AND LEFT(s.service_date,4) = '$year'
                    ) Q";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['income'];
    }

    function GetOutcome($year, $branch) {
        if ($branch != "99") {
            $where = "o.branch = '$branch'";
        } else {
            $where = " 1=1 ";
        }
        $sql = "SELECT IFNULL(SUM(o.priceresult),0) AS outcome
                    FROM orders o 
                    WHERE $where AND LEFT(o.create_date,4) = '$year' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['outcome'];
    }

    function GetIncomePeriod($year = null, $branch = null, $period = null) {
        if ($branch != "99") {
            $wheresell = "o.branch = '$branch'";
            $whereservice = "s.branch = '$branch'";
        } else {
            $wheresell = " 1=1 ";
            $whereservice = " 1=1 ";
        }

        if ($period == '1') {
            $PERIODS = " BETWEEN '01' AND '03' ";
        } else if ($period == '2') {
            $PERIODS = " BETWEEN '04' AND '06' ";
        } else if ($period == '3') {
            $PERIODS = " BETWEEN '07' AND '09' ";
        } else if ($period == '4') {
            $PERIODS = " BETWEEN '10' AND '12' ";
        }

        //AND SUBSTR(i.date_input,6,2) $PERIOD
        $sql = "SELECT IFNULL(SUM(Q.total),0) AS income
                    FROM(
                                SELECT SUM(o.totalfinal) AS total
		FROM logsell o 
		WHERE $wheresell AND LEFT(o.date_sell,4) = '$year' AND SUBSTR(o.date_sell,6,2) $PERIODS

                                UNION

                                SELECT SUM(s.price_total) AS total
                                FROM service s 
                                WHERE $whereservice AND LEFT(s.service_date,4) = '$year'																		
                                    AND SUBSTR(s.service_date,6,2) $PERIODS
                    ) Q";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['income'];
    }

    function GetOutcomePeriod($year = null, $branch = null, $period = null) {
        if ($branch != "99") {
            $where = "o.branch = '$branch'";
        } else {
            $where = " 1=1 ";
        }

        if ($period == '1') {
            $PERIODS = " BETWEEN '01' AND '03' ";
        } else if ($period == '2') {
            $PERIODS = " BETWEEN '04' AND '06' ";
        } else if ($period == '3') {
            $PERIODS = " BETWEEN '07' AND '09' ";
        } else if ($period == '4') {
            $PERIODS = " BETWEEN '10' AND '12' ";
        }

        //AND SUBSTR(i.date_input,6,2) $PERIOD
        $sql = "SELECT IFNULL(SUM(o.priceresult),0) AS outcome
                    FROM orders o 
                    WHERE $where AND LEFT(o.create_date,4) = '$year' 
                        AND SUBSTR(o.create_date,6,2) $PERIODS";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['outcome'];
    }

    function GetIncomeMonth($year = null, $branch = null) {
        if ($branch != "99") {
            $wheresell = "o.branch = '$branch'";
            $whereservice = "s.branch = '$branch'";
        } else {
            $wheresell = " 1=1 ";
            $whereservice = " 1=1 ";
        }
        $sql = "SELECT m.id,m.month_th,IFNULL(SUM(Q.total),0) AS total
                FROM `month` m  
                LEFT JOIN
                (
                    SELECT SUBSTR(o.date_sell,6,2) AS month,SUM(o.totalfinal) AS total
                        FROM logsell o 
                        WHERE $wheresell AND LEFT(o.date_sell,4) = '$year' 
                        GROUP BY SUBSTR(o.date_sell,6,2)

                        UNION

                        SELECT SUBSTR(s.service_date,6,2) AS month,SUM(s.price_total) AS total
                        FROM service s 
                        WHERE $whereservice AND LEFT(s.service_date,4) = '$year'																		
                        GROUP BY SUBSTR(s.service_date,6,2) 
                 ) Q ON m.id = Q.month
                GROUP BY m.id ";
        //return $sql;
        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    function GetOutcomeMonth($year = null, $branch = null) {
        if ($branch != "99") {
            $where = "o.branch = '$branch'";
        } else {
            $where = " 1=1 ";
        }
        $sql = "SELECT m.id,m.month_th,IFNULL(SUM(Q.total),0) AS total
                FROM `month` m  
                LEFT JOIN
                (
                    SELECT SUBSTR(o.create_date,6,2) AS month,SUM(o.priceresult) AS total
                        FROM orders o 
                        WHERE $where AND LEFT(o.create_date,4) = '$year' 
                        GROUP BY SUBSTR(o.create_date,6,2)
                 ) Q ON m.id = Q.month
                GROUP BY m.id ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

}
