<?php

class Contact {

    function get_social_media() {
        $query = "SELECT c.*,m.social_app,m.icon
					FROM contact_social c INNER JOIN massocial m ON c.social_id = m.id
					ORDER BY c.id ASC";
        $result = Yii::app()->db->createCommand($query)->queryAll();
        return $result;
    }

    function mas_social() {
        $rs = Yii::app()->db->createCommand()
                ->select('*')
                ->from('massocial')
                ->queryAll();
        return $rs;
    }

    function gat_contact() {
        $rs = Yii::app()->db->createCommand()
                ->select('*')
                ->from('contact')
                ->queryRow();
        return $rs;
    }

}
