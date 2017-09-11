<?php

/**
 * This is the model class for table "orders".
 *
 * The followings are the available columns in table 'orders':
 * @property integer $id
 * @property string $order_id
 * @property integer $branch
 * @property double $distcount
 * @property double $price
 * @property integer $status
 * @property integer $author
 * @property string $create_date
 * @property string $d_update
 *
 * The followings are the available model relations:
 * @property Listorder[] $listorders
 */
class Orders extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'orders';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('branch, status, author', 'numerical', 'integerOnly' => true),
            array('distcount, price', 'numerical'),
            array('order_id', 'length', 'max' => 10),
            array('create_date, d_update', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, order_id, branch, distcount, price, status, author, create_date, d_update', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'listorders' => array(self::HAS_MANY, 'Listorder', 'order_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'order_id' => 'รหัสรายการ',
            'branch' => 'รหัสสาขา',
            'distcount' => 'ส่วนลด',
            'price' => 'ราคารวม',
            'status' => 'สถานะสั่งซื่อ 0 = ยังไม่ได้ของ,1 = ปลายทางส่งของ,2 = ต้นทางรับของ',
            'author' => 'ผู้สั่งของ',
            'create_date' => 'วันที่สั่งของ',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('order_id', $this->order_id, true);
        $criteria->compare('branch', $this->branch);
        $criteria->compare('distcount', $this->distcount);
        $criteria->compare('price', $this->price);
        $criteria->compare('status', $this->status);
        $criteria->compare('author', $this->author);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('d_update', $this->d_update, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Orders the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    function autoId($table, $value, $number) {
        $rs = Yii::app()->db->createCommand("Select Max($value)+1 as MaxID from  $table")->queryRow(); //เลือกเอาค่า id ที่มากที่สุดในฐานข้อมูลและบวก 1 เข้าไปด้วยเลย
        $new_id = $rs['MaxID'];
        if ($new_id == '') { // ถ้าได้เป็นค่าว่าง หรือ null ก็แสดงว่ายังไม่มีข้อมูลในฐานข้อมูล
            $std_id = sprintf("%0" . $number . "d", 1); //ถ้าไม่ใช่ค่าว่าง
        } else {
            $std_id = sprintf("%0" . $number . "d", $new_id); //ถ้าไม่ใช่ค่าว่าง
        }

        return $std_id;
    }

    function Getlistorder($order_id = null) {
        $sql = "SELECT l.id,l.product_id,l.number,
            l.distcountpercent,l.distcountprice,
            c.product_price,c.costs,c.unit,p.product_name,p.product_nameclinic,u.unit AS unitname
                FROM listorder l INNER JOIN clinic_stockproduct c ON l.product_id = c.product_id
                INNER JOIN center_stockproduct p ON c.product_id = p.product_id
                INNER JOIN unit u ON c.unit = u.id WHERE l.order_id = '$order_id' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function GetlistorderSum($order_id = null) {
        $sql = "SELECT l.product_id,SUM(l.number) AS number
                FROM orders o INNER JOIN listorder l ON o.order_id = l.order_id
                WHERE o.order_id = '$order_id'
                GROUP BY l.product_id ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function GetorderInBranch($branch) {
        $sql = "SELECT o.*,SUM(l.number) AS total,SUM(l.pricetotal) AS pricetotal
                FROM orders o INNER JOIN listorder l ON o.order_id = l.order_id
                WHERE o.branch = '$branch' 
                GROUP BY o.order_id ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function SearchOrder($datestart = null, $dateend = null, $status = null, $branch = null,$order_id = null) {
        if($order_id != ''){
            $WAREORDER = "o.order_id = '$order_id'";
        } else {
            $WAREORDER = " 1=1";
        }
        if ($status != '') {
            $WARESTATUS = " AND o.status = '$status' ";
        } else {
            $WARESTATUS = "";
        }
        
        if($branch == "99"){
            $wherebranch = "";
        } else {
            $wherebranch = " AND o.branch = '$branch' ";
        }

        $sql = "SELECT o.*,
                    SUM(l.number) AS total,
                    SUM(l.pricetotal) AS pricetotal,
                    e.name,
                    e.lname,
                    b.branchname
                FROM orders o INNER JOIN listorder l ON o.order_id = l.order_id
                INNER JOIN employee e ON o.author = e.id
                INNER JOIN branch b ON o.branch = b.id
                WHERE o.create_date BETWEEN '$datestart' AND '$dateend' AND $WAREORDER $wherebranch $WARESTATUS 
                GROUP BY o.order_id ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function SetstatusOrder($status = null) {
        if ($status == '0') {
            $statusVal = "รอยืนยัน";
        } else if ($status == '1') {
            $statusVal = "อยู่ระหว่างการจัดส่ง";
        } else if ($status == '2') {
            $statusVal = "จัดส่งสินค้าแล้ว";
        } else if($status == '3'){
            $statusVal = "สินค้าถึงผู้รับ";
        }

        return $statusVal;
    }

}
