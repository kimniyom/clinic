<?php

/**
 * This is the model class for table "bonuslevel".
 *
 * The followings are the available columns in table 'bonuslevel':
 * @property integer $id
 * @property string $startlevel
 * @property string $endlevel
 * @property string $bonus
 * @property integer $branch
 */
class Bonuslevel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bonuslevel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('branch,startlevel,endlevel,bonus,user_status','required'),
			array('branch,user_status', 'numerical', 'integerOnly'=>true),
			array('startlevel, endlevel, bonus', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, startlevel, endlevel, bonus, branch,user_status', 'safe', 'on'=>'search'),
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
			'startlevel' => 'เริ่มต้น',
			'endlevel' => 'สิ้นสุด',
			'bonus' => 'Bonus',
			'branch' => 'สาขา',
			'user_status' => 'สถานะ'
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
		$criteria->compare('startlevel',$this->startlevel,true);
		$criteria->compare('endlevel',$this->endlevel,true);
		$criteria->compare('bonus',$this->bonus,true);
		$criteria->compare('branch',$this->branch);
		$criteria->compare('user_status',$this->user_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Bonuslevel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
