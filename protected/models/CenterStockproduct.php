<?php

/**
 * This is the model class for table "center_stockproduct".
 *
 * The followings are the available columns in table 'center_stockproduct':
 * @property integer $id
 * @property string $productcode
 * @property string $productname
 * @property integer $cost
 * @property integer $price
 * @property string $expire
 * @property string $create_date
 * @property integer $number
 * @property string $d_update
 */
class CenterStockproduct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'center_stockproduct';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, cost, price, number', 'numerical', 'integerOnly'=>true),
			array('productcode', 'length', 'max'=>20),
			array('productname', 'length', 'max'=>255),
			array('expire, create_date, d_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, productcode, productname, cost, price, expire, create_date, number, d_update', 'safe', 'on'=>'search'),
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
			'productcode' => 'ชื่อสินค้า',
			'productname' => 'ชื่อสินค้า',
			'cost' => 'ต้นทุน',
			'price' => 'ราคาขาย',
			'expire' => 'วันที่หมดอายุ',
			'create_date' => 'วันที่ผลิต',
			'number' => 'คงเหลือ',
			'd_update' => 'D Update',
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
		$criteria->compare('productcode',$this->productcode,true);
		$criteria->compare('productname',$this->productname,true);
		$criteria->compare('cost',$this->cost);
		$criteria->compare('price',$this->price);
		$criteria->compare('expire',$this->expire,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('d_update',$this->d_update,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CenterStockproduct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
