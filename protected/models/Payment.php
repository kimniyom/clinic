<?php

class Payment {

    function Get_patment() {
        $query = "SELECT p.*,b.bank_name,b.bank_img FROM payment p INNER JOIN bank b ON p.bank_id = b.id";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function Get_bank() {
        $query = "SELECT * FROM bank";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

}
