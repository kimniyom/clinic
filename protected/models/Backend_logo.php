<?php

class Backend_logo {

    function get_logo($branch = null) {
        $query = "SELECT * FROM logo WHERE branch = '$branch' ";
        $result = Yii::app()->db->createCommand($query)->queryRow();
        return $result;
    }

    function get_logo_by_id($id = null) {
        $query = "SELECT * FROM logo WHERE id = '$id'";
        $result = Yii::app()->db->createCommand($query)->queryRow();
        return $result;
    }

}
