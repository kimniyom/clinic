<?php

class Configweb_model {

    function get_webname() {
        $sql = "SELECT * FROM webname";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        if ($rs) {
            $webname = $rs['webname'];
        } else {
            $webname = "KimniyomShoping";
        }
        return $webname;
    }

    function get_logoweb() {
        $sql = "SELECT * FROM logo WHERE active = '1' ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        if ($rs) {
            $logo = $rs['logo'];
        } else {
            $logo = "kmlogo.png";
        }
        return $logo;
    }

    function _get_banner() {
        $sql = "SELECT * 
                FROM banner 
                ORDER BY banner_id ASC";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function _get_banner_show() {
        $sql = "SELECT * 
                FROM banner 
                WHERE status = '1'
                ORDER BY banner_id ASC";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

    function pername() {
        $sql = "SELECT oid,pername FROM pername";
        $rs = Yii::app()->db->createCommand($sql)->queryAll();
        return $rs;
    }

    ////////// end //////

    function autoId($table, $value, $number) {
        $rs = Yii::app()->db->createCommand("Select Max($value)+1 as MaxID from  $table")->queryRow(); //เลือกเอาค่า id ที่มากที่สุดในฐานข้อมูลและบวก 1 เข้าไปด้วยเลย
        $new_id = $rs['MaxID'];
        if ($new_id == '') { // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
            $std_id = sprintf("%0" . $number . "d", 1); //ถ้าไม่ใช่ค่าว่าง
        } else {
            $std_id = sprintf("%0" . $number . "d", $new_id); //ถ้าไม่ใช่ค่าว่าง
        }

        return $std_id;
    }

    function thaidate($dateformat = "") {
        if (!empty($dateformat)) {
            $year = substr($dateformat, 0, 4);
            $month = substr($dateformat, 5, 2);
            $day = substr($dateformat, 8, 2);
            $thai = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

            if (strlen($dateformat) <= 10) {
                return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543);
            } else {
                return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543) . " " . substr($dateformat, 10);
            }
        }
    }

    function Monthval() {
        $month = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
        return $month;
    }

    function MonthFull() {
        $thai_month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $thai_month;
    }

    function MonthShot() {
        $thai = array("ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
        return $thai;
    }

    function MonthFullArray() {
        $thai_month = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $thai_month;
    }

    function get_age($birthday = '') {
        $then = strtotime($birthday);
        return(floor((time() - $then) / 31556926));
    }

    function url_encode($url = null) {
        return base64_encode(base64_encode(base64_encode($url)));
    }

    function url_decode($url = null) {
        return base64_decode(base64_decode(base64_decode($url)));
    }

    function Datediff($strDate1 = null, $strDate2 = null) {
        return (strtotime($strDate2) - strtotime($strDate1)) / ( 60 * 60 * 24 );  // 1 day = 60*60*24
    }

    function GetBgWeb($color = null) {
        if (empty($color)) {
            $colors = "#eeeeee";
        } else {
            $colors = $color;
        }
        $str = "style='background:$colors' ";
        return $str;
    }

    function Randstrgen($Number = null) {
        if (empty($Number)) {
            $Numbers = 10;
        } else {
            $Numbers = $Number;
        }
        $len = $Numbers;
        $result = "";
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $charArray = str_split($chars);
        for ($i = 0; $i < $len; $i++) {
            $randItem = array_rand($charArray);
            $result .= "" . $charArray[$randItem];
        }
        return $result;
    }

}
