<?php

/**
 * This is the model class for table "patient_contact".
 *
 * The followings are the available columns in table 'patient_contact':
 * @property integer $patient_id
 * @property string $tel
 * @property string $email
 * @property string $number
 * @property string $tambon
 * @property string $amphur
 * @property string $changwat
 * @property string $zipcode
 */
class PatientContact extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'patient_contact';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('tel,tambon,amphur,changwat,zipcode,number', 'required'),
            array('patient_id', 'numerical', 'integerOnly' => true),
            array('tel, tambon, amphur, changwat, zipcode', 'length', 'max' => 10),
            array('email, number', 'length', 'max' => 100),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('patient_id, tel, email, number, tambon, amphur, changwat, zipcode', 'safe', 'on' => 'search'),
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
            'patient_id' => 'รหัสลูกค้า',
            'tel' => 'เบอร์โทรศัพท์',
            'email' => 'อีเมล์',
            'number' => 'บ้านเลขที่',
            'tambon' => 'ตำบล',
            'amphur' => 'อำเภอ',
            'changwat' => 'จังหวัด',
            'zipcode' => 'รหัสไปรษณีย์',
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

        $criteria->compare('patient_id', $this->patient_id);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('number', $this->number, true);
        $criteria->compare('tambon', $this->tambon, true);
        $criteria->compare('amphur', $this->amphur, true);
        $criteria->compare('changwat', $this->changwat, true);
        $criteria->compare('zipcode', $this->zipcode, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PatientContact the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
