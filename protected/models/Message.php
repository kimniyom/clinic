<?php

class Message {

    function Count_message($pid = null) {
        $query = "SELECT COUNT(DISTINCT(m.msg_id)) AS TOTAL
                        FROM message_answer m INNER JOIN message ms ON m.msg_id = ms.id
                        WHERE m.status_user = 'A' AND ms.pid = '$pid' AND m.`status` = '0' ";
        $result = Yii::app()->db->createCommand($query)->queryRow();
        return $result['TOTAL'];
    }

    function Get_message_short($pid = null) {
        $query = "SELECT ms.id,ms.message
                        FROM message_answer m INNER JOIN message ms ON m.msg_id = ms.id
                        WHERE m.status_user = 'A' AND ms.pid = '$pid' AND m.`status` = '0'
                        GROUP BY m.msg_id ";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_message_all_to_admin($pid = null) {
        $result = Yii::app()->db->createCommand()
                ->select("*")
                ->from("message ms")
                ->where("msg_form = 'U' AND msg_to = 'A' AND ms.pid = '$pid' ")
                ->order("ms.id DESC")
                ->queryAll();
        return $result;
    }

    function Get_read_message($msg_id = null) {
        $result = Yii::app()->db->createCommand()
                ->select("*")
                ->from("message_answer m")
                ->where("m.msg_id = '$msg_id' AND m.status_user = 'A'  AND `status` = '0'")
                ->order("m.id DESC")
                ->limit("1")
                ->queryRow();
        if (!empty($result)) {
            $status = "0";
        } else {
            $status = "1";
        }

        return $status;
    }

    function Get_message_all_to_user() {
        $result = Yii::app()->db->createCommand()
                ->select("ms.*,m.name,m.lname,m.images")
                ->from("message ms")
                ->join("masuser m", "ms.pid = m.pid")
                ->where("msg_form = 'A' AND msg_to = 'U'")
                ->order("ms.id DESC")
                ->queryAll();
        return $result;
    }

    function Get_message_detail($id = null) {
        $result = Yii::app()->db->createCommand()
                ->select("ms.*,m.name,m.lname,m.images")
                ->from("message ms")
                ->join("masuser m", "ms.pid = m.pid")
                ->where("msg_form = 'U' AND msg_to = 'A' AND ms.id = '$id'")
                ->queryRow();
        return $result;
    }

    function Get_answer($msg_id = '') {
        $query = "SELECT ms.*,m.alias,m.`name`,m.lname,m.images
                    FROM message_answer ms INNER JOIN masuser m
                    ON ms.pid = m.pid 
                    WHERE ms.msg_id = '$msg_id' ORDER BY ms.id ASC";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

}
