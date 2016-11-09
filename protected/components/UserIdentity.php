<?php

/**
 * File : protected/components/UserIdentity.php
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    public function authenticate() {
        //$username = strtolower($this->username);
        $user = Masuser::model()->findByAttributes(array('username'=>$this->username));
        if ($user === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($user->password != md5 ($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $user->id;
            $this->username = $user->username;
            $this->errorCode = self::ERROR_NONE;

            //Update lastvisit
            //$date = date("Y-m-d H:i:s");
            //Masuser::model()->updateByPk(array($this->_id), array('d_update' => $date));
            //User::model()->updateCounters(array('count_visit'=>+1),'id=:id',array(':id'=>$this->_id));
        }
        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId() {
        return $this->_id;
    }
    
    public function getUsername(){
        
    }

}
