<?php 
	class ReportStoreCenter {
		public function GetTotalIncome($year = null){
			$sql = "SELECT IFNULL(SUM(l.pricetotal),0) AS pricetotal
					FROM orders o INNER JOIN listorder l ON o.order_id = l.order_id
					WHERE (o.`status` = '2' OR o.`status` = '3')
					AND LEFT(o.create_date,4) = '$year' ";
			return Yii::app()->db->createCommand($sql)->QueryRow();
		}

		public function GetSumorderBranch($year = null){
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

		public function Countorder($year = null){
			$sql = "SELECT COUNT(o.order_id) AS total
					FROM orders o 
					WHERE (o.`status` = '2' OR o.`status` = '3')
					AND LEFT(o.create_date,4) = '$year' ";
			return Yii::app()->db->createCommand($sql)->QueryRow();
		}

		public function Getsumpricebranch($year = null){
			$sql = "SELECT b.id,b.branchname,IFNULL(Q.pricetotal,0) AS pricetotal
					FROM branch b 
					LEFT JOIN(
						SELECT o.branch,SUM(l.pricetotal) AS pricetotal
						FROM orders o INNER JOIN listorder l ON o.order_id = l.order_id
						WHERE (o.`status` = '2' OR o.`status` = '3')
						AND LEFT(o.create_date,4) = '$year'
						GROUP BY o.branch
					) Q ON b.id = Q.branch 
					WHERE b.active = '1' AND b.id != '99' ";
			return Yii::app()->db->createCommand($sql)->QueryAll();
		}

		public function Getsumordermonth($year = null){
			$sql = "SELECT m.month_th,m.month_th_shot,IFNULL(Q.pricetotal,0) AS pricetotal
					FROM `month` m 
					LEFT JOIN(
						SELECT SUBSTR(o.create_date,6,2) AS month,SUM(l.pricetotal) AS pricetotal
						FROM orders o INNER JOIN listorder l ON o.order_id = l.order_id
						WHERE (o.`status` = '2' OR o.`status` = '3')
						AND LEFT(o.create_date,4) = '$year'
						GROUP BY SUBSTR(o.create_date,6,2)
					) Q ON m.id = Q.month ";
			return Yii::app()->db->createCommand($sql)->QueryAll();
		}
	}
?>