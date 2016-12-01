<?php

/**
 * This is the model class for table "menu_report".
 *
 * The followings are the available columns in table 'menu_report':
 * @property integer $id
 * @property string $report_name
 * @property string $url
 *
 * The followings are the available model relations:
 * @property RoleReport[] $roleReports
 */
class MenuReport extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'menu_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('report_name, url', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, report_name, url', 'safe', 'on'=>'search'),
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
			'roleReports' => array(self::HAS_MANY, 'RoleReport', 'report_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'report_name' => 'Report Name',
			'url' => 'Url',
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
		$criteria->compare('report_name',$this->report_name,true);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MenuReport the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	function Getreportmenu($user_id = null){
		$sql = "SELECT m.*,Q1.report_id
				FROM menu_report m 

				LEFT JOIN (SELECT r.report_id FROM role_report r WHERE r.user_id = '$user_id') Q1 

				ON m.id = Q1.report_id  ";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}

	function Getrolemenu($user_id = null){
		$sql = "SELECT m.*
				FROM menu_report m INNER JOIN role_report r ON m.id = r.report_id
				WHERE r.user_id = '$user_id' ";
		return Yii::app()->db->createCommand($sql)->queryAll();
	}
}
