<?php

/**
 * This is the model class for table "service_drug".
 *
 * The followings are the available columns in table 'service_drug':
 * @property integer $id
 * @property integer $patient_id
 * @property integer $drug
 * @property integer $service_id
 * @property integer $user_id
 * @property integer $diagcode
 * @property integer $price
 * @property integer $branch
 * @property string $date_serv
 */
class ServiceDrug extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'service_drug';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('patient_id, drug, service_id, user_id, diagcode, price, branch', 'numerical', 'integerOnly'=>true),
			array('date_serv', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, patient_id, drug, service_id, user_id, diagcode, price, branch, date_serv', 'safe', 'on'=>'search'),
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
			'patient_id' => 'รหัสลูกค้า',
			'drug' => 'รหัสยา / รหัสสินค้า',
			'service_id' => 'รหัสที่มารับบริการ',
			'user_id' => 'ผู้ให้บริการ',
			'diagcode' => 'หัตถการ',
			'price' => 'ราคา',
			'branch' => 'สาขาที่ให้บริการ',
			'date_serv' => 'วันที่บันทึก',
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
		$criteria->compare('patient_id',$this->patient_id);
		$criteria->compare('drug',$this->drug);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('diagcode',$this->diagcode);
		$criteria->compare('price',$this->price);
		$criteria->compare('branch',$this->branch);
		$criteria->compare('date_serv',$this->date_serv,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceDrug the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
