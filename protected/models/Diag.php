<?php

/**
 * This is the model class for table "diag".
 *
 * The followings are the available columns in table 'diag':
 * @property integer $diagcode
 * @property string $diagname
 * @property integer $price
 */
class Diag extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'diag';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('diagname', 'required'),
            array('price', 'numerical', 'integerOnly' => true),
            array('diagname', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('diagcode, diagname, price', 'safe', 'on' => 'search'),
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
            'diagcode' => 'Diagcode',
            'diagname' => 'ชื่อหัตถการ',
            'price' => 'ราคา',
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

        $criteria->compare('diagcode', $this->diagcode);
        $criteria->compare('diagname', $this->diagname, true);
        $criteria->compare('price', $this->price);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Diag the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
