<?php

/**
 * This is the model class for table "mascommision".
 *
 * The followings are the available columns in table 'mascommision':
 * @property integer $id
 * @property string $commisionname
 * @property integer $user_status
 * @property string $valuecom
 * @property integer $typevalue
 */
class Mascommision extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mascommision';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_status,valuecom,typevalue,commisionname','required'),
			array('user_status, typevalue', 'numerical', 'integerOnly'=>true),
			array('commisionname', 'length', 'max'=>255),
			array('valuecom', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, commisionname, user_status, valuecom, typevalue', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'commisionname' => 'ชื่อรายการ',
			'user_status' => 'ประเภทพนักงาน',
			'valuecom' => 'จำนวนเงินหรือ%',
			'typevalue' => 'หน่วย',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('commisionname',$this->commisionname,true);
		$criteria->compare('user_status',$this->user_status);
		$criteria->compare('valuecom',$this->valuecom,true);
		$criteria->compare('typevalue',$this->typevalue);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mascommision the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
