<?php

/**
 * This is the model class for table "checkbody".
 *
 * The followings are the available columns in table 'checkbody':
 * @property integer $id
 * @property integer $patient_id
 * @property string $btemp
 * @property string $pr
 * @property string $rr
 * @property string $date_serv
 * @property integer $branch
 * @property integer $user_id
 */
class Checkbody extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'checkbody';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('patient_id, branch, user_id', 'numerical', 'integerOnly' => true),
            array('btemp, pr', 'length', 'max' => 10),
            array('rr', 'length', 'max' => 255),
            array('date_serv', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, patient_id, btemp, pr, rr, date_serv, branch, user_id', 'safe', 'on' => 'search'),
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
            'id' => 'ID',
            'patient_id' => 'รหัสลูกค้า',
            'btemp' => 'อุณหภมูมิร่างกาย',
            'pr' => 'อัตราการเต้นชองชีพจร',
            'rr' => 'อัตราการหายใจ',
            'date_serv' => 'วันที่รับการตรวจ',
            'branch' => 'สาขาที่รับบบริการ',
            'user_id' => 'ผู้ให้บริการ',
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
        $criteria->compare('patient_id', $this->patient_id);
        $criteria->compare('btemp', $this->btemp, true);
        $criteria->compare('pr', $this->pr, true);
        $criteria->compare('rr', $this->rr, true);
        $criteria->compare('date_serv', $this->date_serv, true);
        $criteria->compare('branch', $this->branch);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Checkbody the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function Checkbody($service_id = null) {
        $sql = "SELECT * FROM checkbody WHERE service_id = '$service_id'";
        $checkbody = Yii::app()->db->createCommand($sql)->queryRow();
        if(!empty($checkbody['id'])){
            return 1;
        } else {
            return 0;
        }
    }
    
    public function Getdetail($servicd_id){
        $sql = "SELECT * FROM checkbody WHERE service_id = '$servicd_id'";
        return Yii::app()->db->createCommand($sql)->queryRow();
    }

}
