<?php

/**
 * This is the model class for table "center_stockitem".
 *
 * The followings are the available columns in table 'center_stockitem':
 * @property integer $id
 * @property string $itemcode
 * @property string $itemname
 * @property integer $total
 * @property integer $price
 * @property integer $unit
 * @property string $lotnumber
 */
class CenterStockitem extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'center_stockitem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('total, price, unit', 'numerical', 'integerOnly'=>true),
			array('itemcode', 'length', 'max'=>10),
			array('itemname', 'length', 'max'=>255),
			array('lotnumber', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, itemcode, itemname, total, price, unit, lotnumber', 'safe', 'on'=>'search'),
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
			'itemcode' => 'รหัสitem',
			'itemname' => 'ชื่อItem',
			'total' => 'คงเหลือ',
			'price' => 'ราคา',
			'unit' => 'หน่วยนับ',
			'lotnumber' => 'ล๊อตเลขที่',
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
		$criteria->compare('itemcode',$this->itemcode,true);
		$criteria->compare('itemname',$this->itemname,true);
		$criteria->compare('total',$this->total);
		$criteria->compare('price',$this->price);
		$criteria->compare('unit',$this->unit);
		$criteria->compare('lotnumber',$this->lotnumber,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CenterStockitem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
