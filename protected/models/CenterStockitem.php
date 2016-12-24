<?php

/**
 * This is the model class for table "center_stockitem".
 *
 * The followings are the available columns in table 'center_stockitem':
 * @property integer $id
 * @property integer $itemid
 * @property integer $total
 * @property integer $price
 * @property string $lotnumber
 * @property integer $number
 * @property string $create_date
 * @property integer $numbercut
 * @property integer $totalcut
 * @property integer $unitcut
 */
class CenterStockitem extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'center_stockitem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('itemid,number,price,lotnumber,numbercut,totalcut', 'required'),
            array('itemid, total, price, number, numbercut, totalcut', 'numerical', 'integerOnly' => true),
            array('lotnumber', 'length', 'max' => 10),
            array('create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, itemid, total, price, lotnumber, number, create_date, numbercut, totalcut', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'itemid' => 'วัตถุดิบ',
            'total' => 'คงเหลือ',
            'price' => 'ราคา',
            'lotnumber' => 'ล๊อตเลขที่',
            'number' => 'จำนวน',
            'create_date' => 'วันที่นำเข้า',
            'numbercut' => 'จำนวนที่ตัดได้',
            'totalcut' => 'ยอดคงเหลือที่ตัดได้',
            'unitcut' => 'หน่วยในการตัด',
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
        $criteria->compare('itemid', $this->itemid);
        $criteria->compare('total', $this->total);
        $criteria->compare('price', $this->price);
        $criteria->compare('lotnumber', $this->lotnumber, true);
        $criteria->compare('number', $this->number);
        $criteria->compare('create_date', $this->create_date, true);
        $criteria->compare('numbercut', $this->numbercut);
        $criteria->compare('totalcut', $this->totalcut);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CenterStockitem the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function Getstockitem() {
        $sql = "SELECT s.*,n.itemcode,n.itemname,n.price AS priceunit,u.unit,us.unit AS unitcutstock
                FROM center_stockitem s INNER JOIN center_stockitem_name n ON s.itemid = n.id
                INNER JOIN center_stockunit u ON n.unit = u.id
                INNER JOIN center_stockunit us ON n.unitcut = us.id";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function Gettotalitem($itemid = null) {
        $sql = "SELECT i.itemid,SUM(i.totalcut) AS total
                FROM center_stockitem i
                WHERE i.itemid = '$itemid' ";
        return Yii::app()->db->createCommand($sql)->queryRow()['total'];
    }

}
