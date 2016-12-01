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

}
