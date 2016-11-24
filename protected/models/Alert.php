<?php

/**
 * This is the model class for table "alert".
 *
 * The followings are the available columns in table 'alert':
 * @property integer $id
 * @property integer $alert_appoint
 * @property integer $alert_product
 * @property integer $alert_expire
 */
class Alert extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alert';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('alert_appoint,alert_product,alert_expire','required'),
			array('alert_appoint, alert_product, alert_expire', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, alert_appoint, alert_product, alert_expire', 'safe', 'on'=>'search'),
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
			'alert_appoint' => 'แจ้งเตือนก่อนถึงวันนัด',
			'alert_product' => 'แจ้งเตือนสินค้าใกล้หมด',
			'alert_expire' => 'แจ้งเตือนสินค้าใกล้หมดอายุ',
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
		$criteria->compare('alert_appoint',$this->alert_appoint);
		$criteria->compare('alert_product',$this->alert_product);
		$criteria->compare('alert_expire',$this->alert_expire);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Alert the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
