<?php

/**
 * This is the model class for table "listorder".
 *
 * The followings are the available columns in table 'listorder':
 * @property integer $id
 * @property string $order_id
 * @property integer $product_id
 * @property integer $number
 * @property double $pricetotal
 * @property string $d_update
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property Orders $order
 */
class Listorder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'listorder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_id, number, status', 'numerical', 'integerOnly'=>true),
			array('pricetotal', 'numerical'),
			array('order_id', 'length', 'max'=>10),
			array('d_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_id, product_id, number, pricetotal, d_update, status', 'safe', 'on'=>'search'),
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
			'order' => array(self::BELONGS_TO, 'Orders', 'order_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'order_id' => 'รหัสรายการ',
			'product_id' => 'รหัสสินค้า',
			'number' => 'จำนวน',
			'pricetotal' => 'รวมราคา',
			'd_update' => 'D Update',
			'status' => '0 = Unactive , 1= Active',
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
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('product_id',$this->product_id);
		$criteria->compare('number',$this->number);
		$criteria->compare('pricetotal',$this->pricetotal);
		$criteria->compare('d_update',$this->d_update,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Listorder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
