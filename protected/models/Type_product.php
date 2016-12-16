<?php

class Type_product extends CActiveRecord{

    public function tableName() {
        return 'product_type';
    }

    function Get_all($upper = null) {
        if(!empty($upper)){
            $Where = " WHERE upper = '$upper' ";
        } else {
            $Where = " WHERE upper = '' OR upper IS NULL";
        }
        $query = "SELECT * FROM product_type $Where ORDER BY type_id";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

}
