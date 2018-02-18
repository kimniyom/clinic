<?php

/**
 * This is the model class for table "repair".
 *
 * The followings are the available columns in table 'repair':
 * @property integer $id
 * @property string $object
 * @property string $detail
 * @property string $price
 * @property integer $user
 * @property string $d_update
 * @property string $date_alert
 * @property integer $status
 */
class Repair extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'repair';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user, status', 'numerical', 'integerOnly'=>true),
			array('object, detail', 'length', 'max'=>255),
			array('price', 'length', 'max'=>10),
			array('d_update, date_alert', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, object, detail, price, user, d_update, date_alert, status', 'safe', 'on'=>'search'),
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
			'object' => 'อุปกรณ์ซ่อม',
			'detail' => 'อาการ',
			'price' => 'ราคา',
			'user' => 'ผู้บันทึก',
			'd_update' => 'วันที่บันทึก',
			'date_alert' => 'วันที่แจ้งเตือนการซ่อม',
			'status' => '0=ยังไม่ซ่อม,1=ซ่อมแล้ว',
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
		$criteria->compare('object',$this->object,true);
		$criteria->compare('detail',$this->detail,true);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('user',$this->user);
		$criteria->compare('d_update',$this->d_update,true);
		$criteria->compare('date_alert',$this->date_alert,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Repair the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
