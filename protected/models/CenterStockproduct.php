<?php

/**
 * This is the model class for table "center_stockproduct".
 *
 * The followings are the available columns in table 'center_stockproduct':
 * @property integer $id
 * @property string $product_id
 * @property string $product_name
 * @property double $costs
 * @property integer $product_price
 * @property string $product_detail
 * @property string $type_id
 * @property integer $delete_flag
 * @property integer $status
 * @property string $d_update
 * @property integer $branch
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
			array('product_price, delete_flag, status, branch', 'numerical', 'integerOnly'=>true),
			array('costs', 'numerical'),
			array('product_id', 'length', 'max'=>20),
			array('product_name', 'length', 'max'=>255),
			array('type_id', 'length', 'max'=>3),
			array('product_detail, d_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, product_name, costs, product_price, product_detail, type_id, delete_flag, status, d_update, branch', 'safe', 'on'=>'search'),
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
			'product_name' => 'ชื่อสินค้า',
			'costs' => 'ต้นทุน',
			'product_price' => 'ราคา',
			'product_detail' => 'รายละเอียด',
			'type_id' => 'รหัส ประเภท',
			'delete_flag' => '0 = ยังไม่ถูกลบ,1 = ลบสินค้าแล้ว',
			'status' => '0 = พร้อมขาย,1 = ไม่พร้อมขาย',
			'd_update' => 'วันที่อัพเดท',
			'branch' => 'สาขา',
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
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('costs',$this->costs);
		$criteria->compare('product_price',$this->product_price);
		$criteria->compare('product_detail',$this->product_detail,true);
		$criteria->compare('type_id',$this->type_id,true);
		$criteria->compare('delete_flag',$this->delete_flag);
		$criteria->compare('status',$this->status);
		$criteria->compare('d_update',$this->d_update,true);
		$criteria->compare('branch',$this->branch);

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
	
	function _get_detail_product($product_id = null) {
        $sql = "SELECT p.product_id,product_name,product_detail,product_price,d_update,p.status,t.type_id,type_name,p.costs
                FROM center_stockproduct p INNER JOIN product_type t ON p.type_id = t.type_id
                WHERE p.product_id = '$product_id' ";
        $result = Yii::app()->db->createCommand($sql)->queryRow();

        return $result;
    }
}
