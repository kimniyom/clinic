<?php

class Type_product extends CActiveRecord{

    public function tableName() {
        return 'product_type';
    }

    function Get_all() {
        $query = "SELECT * FROM product_type ORDER BY type_id";
        return Yii::app()->db->createCommand($query)->queryAll();
    }

}
