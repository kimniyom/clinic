<?php

class Howtoorder{
    function Get_howto(){
        $rs = Yii::app()->db->createCommand()
                ->select("*")
                ->from("howtoorder")
                ->queryRow();
        return $rs['howto'];
    }
}
