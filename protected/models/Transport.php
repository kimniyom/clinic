<?php

class Transport {

    function get_transport() {
        $rs = Yii::app()->db->createCommand()
                ->select('*')
                ->from('transport')
                ->queryAll();
        return $rs;
    }

}
