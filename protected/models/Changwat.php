<?php

/**
 * This is the model class for table "changwat".
 *
 * The followings are the available columns in table 'changwat':
 * @property integer $changwat_id
 * @property string $changwat_code
 * @property string $changwat_name
 * @property integer $geo_id
 */
class Changwat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'changwat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('changwat_code, changwat_name', 'required'),
			array('geo_id', 'numerical', 'integerOnly'=>true),
			array('changwat_code', 'length', 'max'=>2),
			array('changwat_name', 'length', 'max'=>150),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('changwat_id, changwat_code, changwat_name, geo_id', 'safe', 'on'=>'search'),
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
			'changwat_id' => 'Changwat',
			'changwat_code' => 'Changwat Code',
			'changwat_name' => 'Changwat Name',
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

		$criteria->compare('changwat_id',$this->changwat_id);
		$criteria->compare('changwat_code',$this->changwat_code,true);
		$criteria->compare('changwat_name',$this->changwat_name,true);
		$criteria->compare('geo_id',$this->geo_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Changwat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
