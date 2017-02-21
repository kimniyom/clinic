<?php

/**
 * This is the model class for table "companycenter".
 *
 * The followings are the available columns in table 'companycenter':
 * @property integer $id
 * @property string $companyname
 * @property string $address
 * @property string $tel
 * @property string $memager
 */
class Companycenter extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'companycenter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('companyname,memager,tel,tax,address','required'),
			array('companyname, memager', 'length', 'max'=>255),
			array('tel', 'length', 'max'=>15),
			array('tax', 'length', 'max'=>20),
			array('address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, companyname, address, tel, memager, tax', 'safe', 'on'=>'search'),
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
			'companyname' => 'ชื่อบริษัท',
			'address' => 'ที่อยู่',
			'tel' => 'เบอร์โทรศัพท์',
			'memager' => 'ผู้จัดการ',
			'tax' => 'เลขประจำตัวผู้เสียภาษี'
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
		$criteria->compare('companyname',$this->companyname,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('memager',$this->memager,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Companycenter the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
