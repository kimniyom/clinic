<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property integer $id
 * @property string $pid
 * @property integer $user_id
 * @property string $oid
 * @property string $name
 * @property string $lname
 * @property string $alias
 * @property string $email
 * @property string $tel
 * @property string $sex
 * @property string $birth
 * @property string $d_update
 * @property string $create_date
 * @property string $images
 * @property string $walking
 * @property integer $salary
 */
class Employee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                        array('oid,name,lname,email,tel,sex,birth,walking,salary,branch','required'),
			array('salary', 'numerical', 'integerOnly'=>true),
			array('tel', 'length', 'max'=>10),
			array('oid,branch,position', 'length', 'max'=>3),
			array('name, lname, email', 'length', 'max'=>100),
			array('alias, images', 'length', 'max'=>255),
			array('sex', 'length', 'max'=>1),
			array('birth, d_update, create_date, walking', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,oid, name, lname, alias, email, tel, sex, birth, d_update, create_date, images, walking, salary,branch', 'safe', 'on'=>'search'),
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
			'id' => 'รหัส',
			'oid' => 'คำนำหน้า',
			'name' => 'ชื่อ',
			'lname' => 'นามสกุล',
			'alias' => 'ชื่อเล่น',
			'email' => 'อีเมล์',
			'tel' => 'เบอร์โทร',
			'sex' => 'Sex',
			'birth' => 'วันเกิด',
			'd_update' => 'วันที่',
			'create_date' => 'Create Date',
			'images' => 'รูปภาพประจำตัว',
			'walking' => 'วันที่เริ่มทำงาน',
                        'position' => 'ตำแหน่ง',
                        'branch' => 'สาขาที่ปฏิบัติงาน',
			'salary' => 'เงินเดือน',
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
		$criteria->compare('pid',$this->pid,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('oid',$this->oid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('alias',$this->alias,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('birth',$this->birth,true);
		$criteria->compare('d_update',$this->d_update,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('images',$this->images,true);
		$criteria->compare('walking',$this->walking,true);
		$criteria->compare('salary',$this->salary);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


}
