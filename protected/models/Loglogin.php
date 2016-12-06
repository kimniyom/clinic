<?php

/**
 * This is the model class for table "loglogin".
 *
 * The followings are the available columns in table 'loglogin':
 * @property integer $id
 * @property integer $user_id
 * @property integer $branch
 * @property string $date
 */
class Loglogin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'loglogin';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, branch', 'numerical', 'integerOnly'=>true),
			array('date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, branch, date', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'branch' => 'Branch',
			'date' => 'Date',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('branch',$this->branch);
		$criteria->compare('date',$this->date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Loglogin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        function Getloglogin($user_id = null){
            $year = date("Y");
            $sql = " SELECT m.month_th,IFNULL(Q.total,0) AS total
				FROM `month` m 

				LEFT JOIN 
				(
					SELECT SUBSTR(l.date,6,2) AS month,count(*) AS total
					FROM loglogin l 
					WHERE LEFT(l.date,4) = '$year' AND l.user_id = '$user_id'
					GROUP BY SUBSTR(l.date,6,2)
				) Q 
				ON m.id = Q.month ";
            return Yii::app()->db->createCommand($sql)->queryAll();
        }
        
}
