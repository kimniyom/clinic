<?php

/**
 * This is the model class for table "logsell".
 *
 * The followings are the available columns in table 'logsell':
 * @property integer $id
 * @property integer $sell_id
 * @property integer $income
 * @property integer $total
 * @property integer $user_id
 * @property string $card
 * @property integer $branch
 * @property string $date_sell
 * @property integer $change
 */
class Logsell extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'logsell';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sell_id, income, total, user_id, branch, change', 'numerical', 'integerOnly'=>true),
			array('card', 'length', 'max'=>20),
			array('date_sell', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sell_id, income, total, user_id, card, branch, date_sell, change', 'safe', 'on'=>'search'),
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
			'sell_id' => 'Sell',
			'income' => 'Income',
			'total' => 'Total',
			'user_id' => 'User',
			'card' => 'Card',
			'branch' => 'Branch',
			'date_sell' => 'Date Sell',
			'change' => 'Change',
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
		$criteria->compare('sell_id',$this->sell_id);
		$criteria->compare('income',$this->income);
		$criteria->compare('total',$this->total);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('card',$this->card,true);
		$criteria->compare('branch',$this->branch);
		$criteria->compare('date_sell',$this->date_sell,true);
		$criteria->compare('change',$this->change);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Logsell the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
