<?php

/**
 * This is the model class for table "center_stockmix".
 *
 * The followings are the available columns in table 'center_stockmix':
 * @property integer $id
 * @property string $productcode
 * @property string $itemcode
 * @property integer $number
 * @property integer $total
 * @property string $create_date
 */
class CenterStockmix extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'center_stockmix';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('number, total,itemid', 'numerical', 'integerOnly' => true),
            array('product_id, itemcode', 'length', 'max' => 10),
            array('create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, product_id, itemcode, number, total, create_date,itemid', 'safe', 'on' => 'search'),
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
            'product_id' => 'รหัสสินค้า',
            'itemcode' => 'รหัสItem',
            'number' => 'จำนวน',
            'total' => 'คงเหลือ',
            'create_date' => 'วันที่',
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
        $criteria->compare('product_id', $this->product_id, true);
        $criteria->compare('itemcode', $this->itemcode, true);
        $criteria->compare('number', $this->number);
        $criteria->compare('total', $this->total);
        $criteria->compare('create_date', $this->create_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CenterStockmix the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function Getmixer($product_id = null) {
        $sql = "SELECT x.*,n.itemcode AS itemscode,n.itemname,u.unit
                FROM center_stockmix x 
                INNER JOIN center_stockitem_name n ON x.itemid = n.id
                INNER JOIN center_stockunit u ON n.unitcut = u.id 
                WHERE x.product_id = '$product_id' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function Getiteminproduct($product_id = null) {
        $sql = "SELECT x.*,n.itemcode AS itemcodes,n.itemname,n.unitcut,u.unit
                FROM center_stockmix x INNER JOIN center_stockitem_name n ON x.itemid = n.id
                INNER JOIN center_stockunit u ON n.unitcut = u.id
                WHERE x.product_id = '$product_id' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

}
