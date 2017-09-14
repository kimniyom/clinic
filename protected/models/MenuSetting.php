<?php

/**
 * This is the model class for table "menu_setting".
 *
 * The followings are the available columns in table 'menu_setting':
 * @property integer $id
 * @property string $setting
 * @property integer $user_id
 * @property string $url
 *
 * The followings are the available model relations:
 * @property RoleSetting[] $roleSettings
 */
class MenuSetting extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'menu_setting';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('user_id', 'numerical', 'integerOnly' => true),
            array('setting, url', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, setting, user_id, url', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'roleSettings' => array(self::HAS_MANY, 'RoleSetting', 'setting_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'setting' => 'Setting',
            'user_id' => 'User',
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('setting', $this->setting, true);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('url', $this->url, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return MenuSetting the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    function Getsettingmenu($user_id = null) {
        $sql = "SELECT m.*,Q1.setting_id
				FROM menu_setting m 

				LEFT JOIN (SELECT r.setting_id FROM role_setting r WHERE r.user_id = '$user_id') Q1 

				ON m.id = Q1.setting_id ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    function Getrolesetting($user_id = null) {
        $sql = "SELECT m.*
				FROM menu_setting m 
				INNER JOIN role_setting r ON m.id = r.setting_id
				WHERE r.user_id = '$user_id' AND m.active = '0' ";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

}
