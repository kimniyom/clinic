<?php

/**
 * This is the model class for table "masuser".
 *
 * The followings are the available columns in table 'masuser':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $status
 * @property string $d_update
 * @property string $create_date
 * @property integer $flag
 * @property integer $user_id
 */
class Masuser extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'masuser';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username,password,status,user_id', 'required'),
            array('status, flag, user_id', 'numerical', 'integerOnly' => true),
            array('username, password', 'length', 'max' => 100),
            array('d_update, create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, status, d_update, create_date, flag, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'รหัส',
            'username' => 'Username',
            'password' => 'รหัสผ่าน',
            'status' => 'สถานะ',
            'd_update' => 'วันที่',
            'create_date' => 'Create Date',
            'flag' => '0 = ยังเป็นพนักงาน 1 = ยกเลิกการเป็นพนักงาน',
            'user_id' => 'ผู้ใช้งาน',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('d_update', $this->d_update, true);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('flag', $this->flag);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Masuser the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function GetUserAll() {
        $sql = "SELECT m.*,s.`status` AS statusname
                    FROM masuser m 
                    INNER JOIN status_user s 
                    ON m.`status` = s.id

                    WHERE m.flag = '0' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function GetProfile() {
        $userID = Yii::app()->user->id;
        $sql = "
        SELECT e.*,s.`status`,b.branchname
            FROM masuser m INNER JOIN employee e ON m.user_id = e.id
            INNER JOIN status_user s ON m.`status` = s.id
            INNER JOIN branch b ON e.branch = b.id
            WHERE m.id = '$userID' ";

        return Yii::app()->db->createCommand($sql)->queryRow();
    }
    
    public function GetDetailUser($userID) {
        $sql = "
        SELECT p.pername,e.*,s.`status`,b.branchname
            FROM masuser m INNER JOIN employee e ON m.user_id = e.id
            INNER JOIN pername p ON e.oid = p.oid
            INNER JOIN status_user s ON m.`status` = s.id
            INNER JOIN branch b ON e.branch = b.id
            WHERE m.id = '$userID' ";

        return Yii::app()->db->createCommand($sql)->queryRow();
    }
    
    public function GetProfileByID($id) {
        $sql = "
        SELECT e.*,s.`status`,b.branchname
            FROM masuser m INNER JOIN employee e ON m.user_id = e.id
            INNER JOIN status_user s ON m.`status` = s.id
            INNER JOIN branch b ON e.branch = b.id
            WHERE m.id = '$id' ";

        return Yii::app()->db->createCommand($sql)->queryRow();
    }

}
