<?php

/**
 * This is the model class for table "tambon".
 *
 * The followings are the available columns in table 'tambon':
 * @property integer $tambon_id
 * @property string $tambon_code
 * @property string $tambon_name
 * @property integer $ampur_id
 * @property integer $changwat_id
 * @property integer $geo_id
 *
 * The followings are the available model relations:
 * @property Ampur $ampur
 */
class Tambon extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tambon';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tambon_code, tambon_name', 'required'),
			array('ampur_id, changwat_id, geo_id', 'numerical', 'integerOnly'=>true),
			array('tambon_code', 'length', 'max'=>6),
			array('tambon_name', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('tambon_id, tambon_code, tambon_name, ampur_id, changwat_id, geo_id', 'safe', 'on'=>'search'),
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
			'ampur' => array(self::BELONGS_TO, 'Ampur', 'ampur_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tambon_id' => 'Tambon',
			'tambon_code' => 'Tambon Code',
			'tambon_name' => 'Tambon Name',
			'ampur_id' => 'Ampur',
			'changwat_id' => 'Changwat',
			'geo_id' => 'Geo',
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

		$criteria->compare('tambon_id',$this->tambon_id);
		$criteria->compare('tambon_code',$this->tambon_code,true);
		$criteria->compare('tambon_name',$this->tambon_name,true);
		$criteria->compare('ampur_id',$this->ampur_id);
		$criteria->compare('changwat_id',$this->changwat_id);
		$criteria->compare('geo_id',$this->geo_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Tambon the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
