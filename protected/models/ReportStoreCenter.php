<?php

class ReportStoreCenter {

    public function GetTotalIncome($year = null) {
        $sql = "SELECT IFNULL(SUM(o.priceresult),0) AS pricetotal
					FROM orders o 
					WHERE (o.`status` = '2' OR o.`status` = '3')
					AND LEFT(o.create_date,4) = '$year' ";
        return Yii::app()->db->createCommand($sql)->QueryRow();
    }

    public function GetSumorderBranch($year = null) {
        $sql = "SELECT b.id,b.branchname,IFNULL(Q.total,0) AS total
					FROM branch b
					LEFT JOIN(
						SELECT o.branch,COUNT(o.order_id) AS total
						FROM orders o
						WHERE (o.`status` = '2' OR o.`status` = '3')
						AND LEFT(o.create_date,4) = '$year'
						GROUP BY o.branch
					) AS Q ON b.id = Q.branch
					WHERE b.active = 1 AND b.id != '99' ";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function Countorder($year = null) {
        $sql = "SELECT COUNT(o.order_id) AS total
					FROM orders o
					WHERE (o.`status` = '2' OR o.`status` = '3')
					AND LEFT(o.create_date,4) = '$year' ";
        return Yii::app()->db->createCommand($sql)->QueryRow();
    }

    public function Getsumpricebranch($year = null) {
        $sql = "SELECT b.id,b.branchname,IFNULL(Q.pricetotal,0) AS pricetotal
					FROM branch b
					LEFT JOIN(
						SELECT o.branch,SUM(o.priceresult) AS pricetotal
						FROM orders o 
						WHERE (o.`status` = '2' OR o.`status` = '3')
						AND LEFT(o.create_date,4) = '$year'
						GROUP BY o.branch
					) Q ON b.id = Q.branch
					WHERE b.active = '1' AND b.id != '99' ";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function Getsumordermonth($year = null) {
        $sql = "SELECT m.month_th,m.month_th_shot,IFNULL(Q.pricetotal,0) AS pricetotal
					FROM `month` m
					LEFT JOIN(
						SELECT SUBSTR(o.create_date,6,2) AS month,SUM(o.priceresult) AS pricetotal
						FROM orders o 
						WHERE (o.`status` = '2' OR o.`status` = '3')
						AND LEFT(o.create_date,4) = '$year'
						GROUP BY SUBSTR(o.create_date,6,2)
					) Q ON m.id = Q.month";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function Getsumordermonthbranch($year = null, $branch = null) {
        $sql = "SELECT m.month_th,m.month_th_shot,IFNULL(Q.pricetotal,0) AS pricetotal
                    FROM `month` m
                    LEFT JOIN(
                                    SELECT SUBSTR(o.create_date,6,2) AS month,SUM(o.priceresult) AS pricetotal
                                    FROM orders o 
                                    WHERE (o.`status` = '2' OR o.`status` = '3')
                                    AND LEFT(o.create_date,4) = '$year' AND o.branch = '$branch'
                    GROUP BY SUBSTR(o.create_date,6,2)
					) Q ON m.id = Q.month";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function GetordermonthInyear($year = null, $branch = null) {
        $sql = "SELECT m.month_th,m.month_th_shot,IFNULL(Q.totalorder,0) AS total
										FROM `month` m
										LEFT JOIN(
											SELECT SUBSTR(o.create_date,6,2) AS month,COUNT(o.order_id) AS totalorder
											FROM orders o
											WHERE (o.`status` = '2' OR o.`status` = '3')
											AND LEFT(o.create_date,4) = '$year' AND o.branch = '$branch'
											GROUP BY SUBSTR(o.create_date,6,2)
										) Q ON m.id = Q.month ";

        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function GetordermonthPriceInyear($year = null, $branch = null) {
        $sql = "SELECT m.month_th,m.month_th_shot,IFNULL(Q.pricetotal,0) AS total
					FROM `month` m
					LEFT JOIN(
						SELECT SUBSTR(o.create_date,6,2) AS month,SUM(l.pricetotal) AS pricetotal
						FROM orders o INNER JOIN listorder l ON o.order_id = l.order_id
						WHERE (o.`status` = '2' OR o.`status` = '3')
						AND LEFT(o.create_date,4) = '$year' AND o.branch = '$branch'
						GROUP BY SUBSTR(o.create_date,6,2)
					) Q ON m.id = Q.month ";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function ReportInputItemPeriod($year) {
        $sql = "SELECT c.itemid,cn.itemcode,cn.itemname,u.unit,
                        SUM(IF(LEFT(c.lotnumber,6) BETWEEN CONCAT('$year','01') AND CONCAT('$year','03'),number,0)) AS period1,
                        SUM(IF(LEFT(c.lotnumber,6) BETWEEN CONCAT('$year','04') AND CONCAT('$year','06'),number,0)) AS period2,
                        SUM(IF(LEFT(c.lotnumber,6) BETWEEN CONCAT('$year','07') AND CONCAT('$year','09'),number,0)) AS period3,
                        SUM(IF(LEFT(c.lotnumber,6) BETWEEN CONCAT('$year','10') AND CONCAT('$year','12'),number,0)) AS period4
                FROM center_stockitem c INNER JOIN center_stockitem_name cn ON c.itemid = cn.id
                INNER JOIN center_stockunit u ON cn.unit = u.id
                GROUP BY c.itemid ORDER BY cn.id ASC";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function ReportInputItemPeriodPrice($year) {
        $sql = "SELECT c.itemid,cn.itemcode,cn.itemname,
                        SUM(IF(LEFT(c.lotnumber,6) BETWEEN CONCAT('$year','01') AND CONCAT('$year','03'),c.price,0)) AS period1,
                        SUM(IF(LEFT(c.lotnumber,6) BETWEEN CONCAT('$year','04') AND CONCAT('$year','06'),c.price,0)) AS period2,
                        SUM(IF(LEFT(c.lotnumber,6) BETWEEN CONCAT('$year','07') AND CONCAT('$year','09'),c.price,0)) AS period3,
                        SUM(IF(LEFT(c.lotnumber,6) BETWEEN CONCAT('$year','10') AND CONCAT('$year','12'),c.price,0)) AS period4
                FROM center_stockitem c INNER JOIN center_stockitem_name cn ON c.itemid = cn.id
                GROUP BY c.itemid ORDER BY cn.id ASC";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function ReportInputItemMonth($year = null) {
        $sql = "SELECT c.itemid,cn.itemcode,cn.itemname,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','01'),c.number,0)) AS month1,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','02'),c.number,0)) AS month2,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','03'),c.number,0)) AS month3,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','04'),c.number,0)) AS month4,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','05'),c.number,0)) AS month5,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','06'),c.number,0)) AS month6,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','07'),c.number,0)) AS month7,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','08'),c.number,0)) AS month8,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','09'),c.number,0)) AS month9,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','10'),c.number,0)) AS month10,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','11'),c.number,0)) AS month11,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','12'),c.number,0)) AS month12
                FROM center_stockitem c INNER JOIN center_stockitem_name cn ON c.itemid = cn.id
                GROUP BY c.itemid ";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function ReportInputItemMonthPrice($year = null) {
        $sql = "SELECT c.itemid,cn.itemcode,cn.itemname,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','01'),c.price,0)) AS month1,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','02'),c.price,0)) AS month2,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','03'),c.price,0)) AS month3,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','04'),c.price,0)) AS month4,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','05'),c.price,0)) AS month5,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','06'),c.price,0)) AS month6,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','07'),c.price,0)) AS month7,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','08'),c.price,0)) AS month8,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','09'),c.price,0)) AS month9,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','10'),c.price,0)) AS month10,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','11'),c.price,0)) AS month11,
                        SUM(IF(LEFT(c.lotnumber,6) = CONCAT('$year','12'),c.price,0)) AS month12
                FROM center_stockitem c INNER JOIN center_stockitem_name cn ON c.itemid = cn.id
                GROUP BY c.itemid ";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

    public function GetSumOutcome($year = null) {
        $sql = "SELECT SUM(c.price) AS total
                    FROM center_stockitem c
                    WHERE LEFT(c.lotnumber,4) = '$year' ";
        return Yii::app()->db->createCommand($sql)->QueryRow();
    }

    public function GetSumIncome($year = null) {
        $sql = "SELECT SUM(o.priceresult) AS total
                    FROM orders o
                    WHERE (o.`status` = '1' OR o.`status` = '2')
                    AND LEFT(o.create_date,4) = '$year' ";
        return Yii::app()->db->createCommand($sql)->QueryRow();
    }

    public function GetchartProfit($year = null) {
        $sql = "SELECT m.month_th,
                        IFNULL(Q.total,0) AS income,
                        IFNULL(Q2.priceoutcome,0) AS outcome,
                        IFNULL((IFNULL(Q.total,0) - IFNULL(Q2.priceoutcome,0)),0) AS profit
                FROM `month` m 
                    LEFT JOIN 
                        (
                            SELECT SUBSTR(o.create_date,6,2) AS month,SUM(o.priceresult) AS total
                            FROM orders o 
                            WHERE LEFT(o.create_date,4) = '$year' AND (o.status = '1' OR o.status = '2')
                            GROUP BY SUBSTR(o.create_date,6,2)
                        ) Q ON m.id = Q.month

                    LEFT JOIN 

                        (
                            SELECT SUBSTR(i.lotnumber,5,2) AS monthoutcome,SUM(i.price) AS priceoutcome
                            FROM center_stockitem i 
                            WHERE LEFT(i.lotnumber,4) = '$year'
                            GROUP BY SUBSTR(i.lotnumber,5,2)
                        ) Q2 ON m.id = Q2.monthoutcome 
                ORDER BY m.id ASC";
        return Yii::app()->db->createCommand($sql)->QueryAll();
    }

}

?>
