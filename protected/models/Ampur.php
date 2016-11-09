<?php

/**
 * This is the model class for table "ampur".
 *
 * The followings are the available columns in table 'ampur':
 * @property integer $ampur_id
 * @property string $ampur_code
 * @property string $ampur_name
 * @property integer $geo_id
 * @property integer $changwat_id
 *
 * The followings are the available model relations:
 * @property Tambon[] $tambons
 */
class Ampur extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ampur';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ampur_code, ampur_name', 'required'),
			array('geo_id, changwat_id', 'numerical', 'integerOnly'=>true),
			array('ampur_code', 'length', 'max'=>4),
			array('ampur_name', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ampur_id, ampur_code, ampur_name, geo_id, changwat_id', 'safe', 'on'=>'search'),
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
			'tambons' => array(self::HAS_MANY, 'Tambon', 'ampur_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ampur_id' => 'Ampur',
			'ampur_code' => 'Ampur Code',
			'ampur_name' => 'Ampur Name',
			'geo_id' => 'Geo',
			'changwat_id' => 'Changwat',
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

		$criteria->compare('ampur_id',$this->ampur_id);
		$criteria->compare('ampur_code',$this->ampur_code,true);
		$criteria->compare('ampur_name',$this->ampur_name,true);
		$criteria->compare('geo_id',$this->geo_id);
		$criteria->compare('changwat_id',$this->changwat_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Ampur the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
