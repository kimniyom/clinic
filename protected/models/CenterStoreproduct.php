<?php

/**
 * This is the model class for table "center_storeproduct".
 *
 * The followings are the available columns in table 'center_storeproduct':
 * @property integer $id
 * @property string $product_id
 * @property string $lotnumber
 * @property string $generate
 * @property string $expire
 * @property string $d_update
 * @property integer $number
 * @property integer $total
 */
class CenterStoreproduct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'center_storeproduct';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('number, total', 'numerical', 'integerOnly'=>true),
			array('product_id', 'length', 'max'=>20),
			array('lotnumber', 'length', 'max'=>10),
			array('generate, expire, d_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, lotnumber, generate, expire, d_update, number, total', 'safe', 'on'=>'search'),
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
			'product_id' => 'รหัสสินค้า',
			'lotnumber' => 'เลขล๊อต',
			'generate' => 'วันที่ผลิต',
			'expire' => 'วันที่หมดอายุ',
			'd_update' => 'วันที่อัพเดท',
			'number' => 'จำนวน',
			'total' => 'คงเหลือ',
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
		$criteria->compare('product_id',$this->product_id,true);
		$criteria->compare('lotnumber',$this->lotnumber,true);
		$criteria->compare('generate',$this->generate,true);
		$criteria->compare('expire',$this->expire,true);
		$criteria->compare('d_update',$this->d_update,true);
		$criteria->compare('number',$this->number);
		$criteria->compare('total',$this->total);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CenterStoreproduct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function Searchstore($type_id, $subproducttype){
		if($type_id == '' && $subproducttype == ''){
			$where = "1=1";
		} else if($type_id != '' && $subproducttype == ''){
			$where = "c.type_id = '$type_id' ";
		} else {
			$where = "c.subproducttype = '$subproducttype' ";
		}
		$sql = "SELECT s.*,c.product_name,c.product_price,c.costs,u.unit,c.type_id,c.subproducttype,t.type_name AS category,pt.type_name
				FROM center_storeproduct s INNER JOIN center_stockproduct c ON s.product_id = c.product_id
				INNER JOIN unit u ON c.unit = u.id
				INNER JOIN product_type t ON c.type_id = t.id
				INNER JOIN product_type pt ON c.subproducttype = pt.id 
				WHERE $where
				ORDER BY s.d_update,s.lotnumber";
	   return Yii::app()->db->createCommand($sql)->queryAll();
	}
        
        
        //Function ตัดสต๊อก
        
}
