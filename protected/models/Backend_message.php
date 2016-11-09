<?php

class Backend_message{
    function Count_message(){
        $result = Yii::app()->db->createCommand()
                ->select("count(*) AS TOTAL")
                ->from("message")
                ->where("msg_form = 'U' AND msg_to = 'A' AND status = '0' ")
                ->queryRow();
        return $result['TOTAL'];
    }
    
    function Get_message_short(){
        $result = Yii::app()->db->createCommand()
                ->select("ms.*,m.name,m.lname,m.images")
                ->from("message ms")
                ->join("masuser m", "ms.pid = m.pid")
                ->where("msg_form = 'U' AND msg_to = 'A' AND ms.status = '0'")
                ->order("ms.id DESC")
                ->limit("10")
                ->queryAll();
        return $result;
    }
    
    function Get_message_all_to_admin(){
        $result = Yii::app()->db->createCommand()
                ->select("ms.*,m.name,m.lname,m.images")
                ->from("message ms")
                ->join("masuser m", "ms.pid = m.pid")
                ->where("msg_form = 'U' AND msg_to = 'A'")
                ->order("ms.id DESC")
                ->queryAll();
        return $result;
    }
    
    function Get_message_all_to_user(){
        $result = Yii::app()->db->createCommand()
                ->select("ms.*,m.name,m.lname,m.images")
                ->from("message ms")
                ->join("masuser m", "ms.pid = m.pid")
                ->where("msg_form = 'A' AND msg_to = 'U'")
                ->order("ms.id DESC")
                ->queryAll();
        return $result;
    }
    
    function Get_message_detail($id = null){
        $result = Yii::app()->db->createCommand()
                ->select("ms.*,m.name,m.lname,m.images")
                ->from("message ms")
                ->join("masuser m", "ms.pid = m.pid")
                ->where("msg_form = 'U' AND msg_to = 'A' AND ms.id = '$id'")
                ->queryRow();
        return $result;
    }
    
    function Get_answer($msg_id = ''){
        $query = "SELECT ms.*,m.alias,m.`name`,m.lname,m.images
                    FROM message_answer ms INNER JOIN masuser m
                    ON ms.pid = m.pid 
                    WHERE ms.msg_id = '$msg_id' ORDER BY ms.id ASC";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }
}
