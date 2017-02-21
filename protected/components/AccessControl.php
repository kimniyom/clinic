<?php

class AccessControl extends CApplicationComponent {

    public static function check_access($group) {
        if (Yii::app()->user->id) {
            $return = false;
            $model = User::model()->findByAttributes(array('username' => Yii::app()->user->id));
            if (!empty($model)) {
                if (is_integer($group)) {
                    if ($model->group == $group) {
                        $return = true;
                    }
                }
                if (is_array($group)) {
                    foreach ($group as $value) {
                        if ($model->group == $value) {
                            $return = true;
                        }
                    }
                }
            }
            return $return;
        } else {
            return false;
        }
    }

    public function Css() {
        $Path = Yii::app()->baseUrl . "/themes/backend/";
        $str = "";
        $str .= "<link rel='stylesheet' type='text/css' href='" . $Path . "css/template.css'/>";
        $str .= "<link rel='stylesheet' type='text/css' href='" . $Path . "css/system.css'/>";
        $str .= "<link rel='stylesheet' type='text/css' href='" . $Path . "bootstrap/css/bootstrap.css' type='text/css' media='all' />";
        $str .= "<link rel='stylesheet' type='text/css' href='" . $Path . "bootstrap/css/bootstrap-theme.css' type='text/css' media='all' />";
    
        return $str;
    }

    public function Js() {
        $Path = Yii::app()->baseUrl . "/themes/backend/";
        $str = "";
        $str .= "<script src='".$Path."bootstrap/js/bootstrap.js' type='text/javascript'></script>";
        
        return $str;
    }

}
