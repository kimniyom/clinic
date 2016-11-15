<?php

class Backend_Product {

    function _get_product_type_where($type_id = '') {
        $sql = "SELECT id,type_id,type_name
                FROM product_type
                WHERE type_id = '$type_id' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_product_type() {
        $sql = "SELECT id,type_id,type_name
                FROM product_type";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_product($type_id = '') {
        if ($type_id != '') {
            $w = "type_id = '$type_id' AND delete_flag != '1'";
        } else {
            $w = "1 = 1 AND delete_flag != '1'";
        }
        $sql = "SELECT *
                FROM product
                WHERE $w ";
        //return $sql;
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_cart_count($order_id = null) {
        $sql = "SELECT SUM(product_num) AS total
                FROM basket
                WHERE order_id = '$order_id' ";

        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result['total'];
    }

    function _get_cart_sum($order_id = null) {
        $sql = "SELECT p.product_id,p.product_price,l.product_num
                FROM basket l INNER JOIN product p ON l.product_id = p.product_id
                WHERE order_id = '$order_id' ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    /*
      function _get_list_order_product($order_id = '') {
      $sql = "SELECT p.product_id,l.price,l.id,p.product_price,l.product_number,p.product_name,p.product_detail
      FROM orders l INNER JOIN product p ON l.product_id = p.product_id
      WHERE order_id = '$order_id' ";

      return Yii::app()->db->createCommand($sql)->queryAll();
      }
     */

    function _get_last_product() {
        $sql = "SELECT *
                FROM product
                WHERE delete_flag != '1'
                ORDER BY id DESC LIMIT 9";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_detail_product($product_id = '') {
        $sql = "SELECT p.product_id,product_name,product_detail,product_price,d_update,p.status,t.type_id,type_name,p.branch,p.costs
                FROM product p INNER JOIN product_type t ON p.type_id = t.type_id
                WHERE p.product_id = '$product_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();

        return $result;
    }

    function _get_order_confrim() {
        $member = Yii::app()->session['member'];
        $pid = $member['pid'];
        $sql = "SELECT o.order_id,o.pid,o.order_date,o.status,
                       SUM(price*product_number) AS price_total,SUM(product_number) AS total_number
                FROM orders o
                WHERE o.pid = '$pid' AND o.status = '1'
                GROUP BY o.order_id ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_order() {
        $member = Yii::app()->session['member'];
        $pid = $member['pid'];
        $sql = "SELECT o.order_id,o.pid,o.order_date,o.status,
                        SUM(price*product_number) AS price_total,SUM(product_number) AS total_number
                FROM orders o
                WHERE o.pid = '$pid' AND o.status = '0'
                GROUP BY o.order_id ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_order_success() {
        $member = Yii::app()->session['member'];
        $pid = $member['pid'];
        $sql = "SELECT o.order_id,o.pid,o.order_date,o.status,
                        SUM(price*product_number) AS price_total,SUM(product_number) AS total_number,
                        postcode,date_send
                FROM orders o
                WHERE o.pid = '$pid' AND o.status = '2'
                GROUP BY o.order_id ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_order_confrim_admin() {
        $sql = "SELECT o.pid,o.order_id,o.order_date,o.status,
                        SUM(price*product_number) AS price_total,SUM(product_number) AS total_number,
                        n.date_tranfer,n.time_tranfer,n.money,n.bill
                FROM orders o INNER JOIN notify n ON o.order_id = n.order_id
                WHERE o.status = '1' AND ISNULL(n.status)
                GROUP BY o.order_id ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_count_order() {
        $query = "SELECT IFNULL(COUNT(*),0) AS TOTAL
                    FROM orders o INNER JOIN notify n ON o.order_id = n.order_id
                    WHERE o.status = '1' AND ISNULL(n.status)
                    GROUP BY o.order_id ";

        $rs = Yii::app()->db->createCommand($query)->queryRow();
        if ($rs) {
            return $rs['TOTAL'];
        } else {
            return "0";
        }
    }

    function _get_detail_order($order_id = '') {
        $sql = "SELECT o.pid,o.order_id,o.order_date,o.status,
                        SUM(price*product_number) AS price_total,SUM(product_number) AS total_number,
                        n.date_tranfer,n.time_tranfer,n.money,n.bill
                FROM orders o INNER JOIN notify n ON o.order_id = n.order_id
                WHERE o.status = '1' AND o.order_id = '$order_id' ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function _get_check_address($order_id = '') {
        $sql = "SELECT o.pid,p.pername,m.name,m.lname,m.address,m.email,m.tel,m.card
                FROM orders o INNER JOIN masuser m ON o.pid = m.pid
                    INNER JOIN pername p ON m.oid = p.oid
                WHERE o.order_id = '$order_id'
                GROUP BY o.order_id ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_confrim_notify() {
        $sql = "SELECT o.pid,o.order_id,o.order_date,o.status,m.name,m.lname,IF(o.postcode != '','1','0') AS code_send,
                        SUM(price*product_number) AS price_total,SUM(product_number) AS total_number,
                        n.date_tranfer,n.time_tranfer,n.money,n.bill
                FROM orders o INNER JOIN notify n ON o.order_id = n.order_id
                    INNER JOIN masuser m ON o.pid = m.pid
                WHERE n.status = '1'
                GROUP BY o.order_id";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_sale_product() {
        $sql = "SELECT p.product_id,p.product_name,p.product_price,p.product_detail,COUNT(o.product_id) AS total
                FROM basket o INNER JOIN product p ON o.product_id = p.product_id
                WHERE p.delete_flag != '1'
                GROUP BY o.product_id
                ORDER BY total DESC
                LIMIT 5";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function _get_search_product($w1 = '', $w3 = '') {
        $sql = "SELECT *
                FROM product
                WHERE $w1 $w3 AND delete_flag != '1'";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function print_bill($order_id = '') {
        $sql = "SELECT *
                FROM notify
                WHERE order_id = '$order_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result;
    }

    function get_last_img($product_id = '') {
        $sql = "SELECT IFNULL(images,'-') AS  images FROM product_images WHERE product_id = '$product_id' LIMIT 1";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if (!empty($result)) {
            return $result['images'];
        } else {
            return "No-Camera-icon.png";
        }
    }

    function get_product_all($type_id = '') {
        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $WHEREBRACH = " AND 1=1";
        } else {
            $WHEREBRACH = "AND brach = '$branch' ";
        }
        $sql = "SELECT * FROM product WHERE type_id = '$type_id' AND delete_flag != '1' $WHEREBRACH";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_type_name($type_id = '') {
        $sql = "SELECT type_name FROM product_type WHERE type_id = '$type_id' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['type_name'];
    }

    function get_count_product_type($type_id = '') {
        $sql = "SELECT COUNT(*) AS TOTAL FROM product WHERE type_id = '$type_id' AND delete_flag != '1'";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['TOTAL'];
    }

    function get_images_product($product_id = '') {
        $sql = "SELECT product_images.id,images FROM product_images WHERE product_id = '$product_id' AND active != '1'";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_images_product_title($product_id = '') {
        $sql = "SELECT product_images.id,images FROM product_images WHERE product_id = '$product_id' AND active = '1' ";
        return Yii::app()->db->createCommand($sql)->queryRow();
    }

    function get_notify_postcode() {
        $sql = "SELECT o.order_id,o.postcode,m.`name`,m.lname
                    FROM orders o INNER JOIN masuser m ON o.pid = m.pid
                    WHERE o.postcode != ''
                    GROUP BY o.order_id ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function get_product_near($productId = '') {
        $query = "SELECT id FROM product WHERE product_id = '$productId' AND delete_flag != '1'";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        $ID = $rs['id'];
        $sql = "SELECT p.*,Q1.images
                    FROM product p
                            INNER JOIN
                            (
                                    SELECT i.product_id,i.images
                                    FROM product_images i
                                    GROUP BY i.product_id
                            ) Q1
                    ON p.product_id = Q1.product_id
                    WHERE p.id BETWEEN ($ID-2) AND ($ID+2) AND p.product_id != '$productId'
                    LIMIT 4 ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function count_product_all() {
        $query = "SELECT COUNT(*) AS product_total
                    FROM product
                    WHERE delete_flag != '1'";
        $rs = Yii::app()->db->createCommand($query)->queryRow();
        if ($rs) {
            return $rs['product_total'];
        } else {
            return "0";
        }
    }

    function stockproductalert() {
        $branch = Yii::app()->session['branch'];
        if ($branch == '99') {
            $branchwhere = "1=1";
        } else {
            $branchwhere = "p.branch = '$branch' ";
        }
        $sql = "SELECT COUNT(*) AS TOTAL
                FROM
                (
                        SELECT i.product_id,COUNT(*) AS TOTAL 
                        FROM items i INNER JOIN product p ON i.product_id = p.product_id
                        WHERE $branchwhere AND i.status = '0'
                        GROUP BY i.product_id
                ) Q

        WHERE Q.TOTAL < 5 ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result['TOTAL'];
    }

    function stockitemalert() {
        $branch = Yii::app()->session['branch'];
        if ($branch == '99') {
            $branchwhere = "1=1";
        } else {
            $branchwhere = "p.branch = '$branch' ";
        }

        $sql = "SELECT COUNT(*) AS TOTAL
                FROM items i INNER JOIN product p ON i.product_id = p.product_id
                WHERE $branchwhere AND DATEDIFF(i.expire,NOW()) < 30 AND  i.status = '0'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        return $result['TOTAL'];
    }

    function Getstockproductalert() {
        $branch = Yii::app()->session['branch'];
        if ($branch == '99') {
            $branchwhere = "1=1";
        } else {
            $branchwhere = "p.branch = '$branch' ";
        }
        $sql = "SELECT p.*,COUNT(*) AS TOTAL 
                FROM items i INNER JOIN product p ON i.product_id = p.product_id
                WHERE p.branch = $branchwhere AND  i.status = '0'
                GROUP BY i.product_id ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function Getstockitemalert() {
        $branch = Yii::app()->session['branch'];
        if ($branch == '99') {
            $branchwhere = "1=1";
        } else {
            $branchwhere = "p.branch = '$branch' ";
        }
        $sql = "SELECT p.product_name,i.itemcode,i.product_id,DATEDIFF(i.expire,NOW()) AS expire,i.expire AS dateexpire
                FROM items i INNER JOIN product p ON i.product_id = p.product_id
                WHERE DATEDIFF(i.expire,NOW()) < 30 AND $branchwhere AND  i.status = '0'
                ORDER BY DATEDIFF(i.expire,NOW()) ASC ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

}
