<?php

/**
 * This is the model class for table "clinic_stockproduct".
 *
 * The followings are the available columns in table 'clinic_stockproduct':
 * @property integer $id
 * @property string $product_id
 * @property string $clinicname
 * @property string $product_name
 * @property string $product_nameclinic
 * @property double $costs
 * @property integer $product_price
 * @property string $product_detail
 * @property integer $type_id
 * @property integer $delete_flag
 * @property integer $status
 * @property string $d_update
 * @property integer $branch
 * @property integer $subproducttype
 * @property integer $unit
 * @property string $company
 * @property string $size
 * @property integer $private
 */
class ClinicStockproduct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'clinic_stockproduct';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('product_price, type_id, delete_flag, status, branch, subproducttype, unit, private', 'numerical', 'integerOnly'=>true),
			array('costs', 'numerical'),
			array('product_id', 'length', 'max'=>20),
			array('clinicname, product_name, product_nameclinic, size', 'length', 'max'=>255),
			array('company', 'length', 'max'=>5),
			array('product_detail, d_update', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, product_id, clinicname, product_name, product_nameclinic, costs, product_price, product_detail, type_id, delete_flag, status, d_update, branch, subproducttype, unit, company, size, private', 'safe', 'on'=>'search'),
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
			'clinicname' => 'ชื่อที่คลินิกเรียก',
			'product_name' => 'ชื่อสินค้าส่วนกลาง',
			'product_nameclinic' => 'ชื่อสินค้า',
			'costs' => 'ต้นทุน',
			'product_price' => 'ราคา',
			'product_detail' => 'รายละเอียด',
			'type_id' => 'หมวดสินค้า',
			'delete_flag' => '0 = ยังไม่ถูกลบ,1 = ลบสินค้าแล้ว',
			'status' => '0 = พร้อมขาย,1 = ไม่พร้อมขาย',
			'd_update' => 'วันที่อัพเดท',
			'branch' => 'สาขา',
			'subproducttype' => 'ประเภท',
			'unit' => 'หน่วยนับ',
			'company' => 'รหัสบริษัทสั่งซื้อ',
			'size' => 'ขนาด',
			'private' => '0 = คลินิกมองเห็น , 1 = คลินิกมองไม่เห็น',
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
		$criteria->compare('clinicname',$this->clinicname,true);
		$criteria->compare('product_name',$this->product_name,true);
		$criteria->compare('product_nameclinic',$this->product_nameclinic,true);
		$criteria->compare('costs',$this->costs);
		$criteria->compare('product_price',$this->product_price);
		$criteria->compare('product_detail',$this->product_detail,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('delete_flag',$this->delete_flag);
		$criteria->compare('status',$this->status);
		$criteria->compare('d_update',$this->d_update,true);
		$criteria->compare('branch',$this->branch);
		$criteria->compare('subproducttype',$this->subproducttype);
		$criteria->compare('unit',$this->unit);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('size',$this->size,true);
		$criteria->compare('private',$this->private);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ClinicStockproduct the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        function GetproductlistSearch($type_id = null,$subproducttype = null,$branch = null){
		if($type_id == '' && $subproducttype == ''){
			$where = "1=1";
		} else if($type_id != '' && $subproducttype == ''){
			$where = "p.type_id = '$type_id' ";
		} else {
			$where = "p.subproducttype = '$subproducttype' ";
		}
		$sql = "SELECT p.*,t.type_name AS category,tp.type_name,u.unit AS unitname
				FROM clinic_stockproduct p INNER JOIN unit u ON p.unit = u.id
				INNER JOIN product_type t ON p.type_id = t.id
				INNER JOIN product_type tp ON p.subproducttype = tp.id 
				WHERE $where AND p.branch = '$branch'
				ORDER BY t.upper,t.sublevel ";
		
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		
		return $result;
	}

	function _get_detail_product($product_id = null,$branch = null) {
		$sql = "SELECT p.id,p.subproducttype,p.product_id,c.product_name,c.product_nameclinic,c.product_detail,p.product_price,p.d_update,p.status,p.costs,
                                p.type_id,t.type_name,p.costs,u.id AS unit_id,u.unit,tp.type_name AS subtypename
                FROM clinic_stockproduct p 
				INNER JOIN center_stockproduct c ON p.product_id = c.product_id
				INNER JOIN product_type t ON p.type_id = t.id
				INNER JOIN product_type tp ON p.subproducttype = tp.id 
				INNER JOIN unit u ON p.unit = u.id
                WHERE p.product_id = '$product_id' AND p.branch = '$branch' ";
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
	}

	function _get_detail_productByid($id) {
		$sql = "SELECT p.id,
						p.subproducttype,
						p.product_id,c.product_name,
						c.product_nameclinic,
						c.product_detail,
						p.product_price,
						p.d_update,
						p.status,
						p.costs,
						p.branch,
                    	p.type_id,t.type_name,p.costs,u.id AS unit_id,u.unit,tp.type_name AS subtypename
                FROM clinic_stockproduct p 
				INNER JOIN center_stockproduct c ON p.product_id = c.product_id
				INNER JOIN product_type t ON p.type_id = t.id
				INNER JOIN product_type tp ON p.subproducttype = tp.id 
				INNER JOIN unit u ON p.unit = u.id
                WHERE p.id = '$id' ";
		$result = Yii::app()->db->createCommand($sql)->queryRow();
		
		return $result;
	}

	function comboproduct($subproduct,$branch){
		$sql = "SELECT c.product_id,s.product_nameclinic
				FROM clinic_stockproduct c INNER JOIN center_stockproduct s ON c.product_id = s.product_id
				WHERE s.subproducttype = '$subproduct' AND c.branch = '$branch' ";
		$result = Yii::app()->db->createCommand($sql)->queryAll();
		return $result;
	}
}
