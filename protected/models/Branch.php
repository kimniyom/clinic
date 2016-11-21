<?php

/**
 * This is the model class for table "branch".
 *
 * The followings are the available columns in table 'branch':
 * @property integer $id
 * @property string $branchname
 */
class Branch extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'branch';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('branchname', 'required'),
            array('branchname', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, branchname', 'safe', 'on' => 'search'),
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
            'id' => 'รหัสสาขา',
            'branchname' => 'ชื่อสาขา',
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
        $criteria->compare('branchname', $this->branchname, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Branch the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function Getbranch($id = null) {
        return Branch::model()->find("id = '$id'")['branchname'];
    }

    public function ComboBranch($branchactive = null) {
        $branchList = Branch::model()->findAll("active = '1'");

        if (empty($branchactive)) {
            $branch = Yii::app()->session['branch'];
            if ($branch == "99") {
                $active = "";
                $disabled = "";
            } else {
                $active = $branch;
                $disabled = 'disabled="disabled"';
            }
        } else {
            $active = $branchactive;
            $disabled = "";
        }



        $str = "";
        $str.='<select id="branch" class="form-control">';
        foreach ($branchList as $b):
            $str.= '<option value="' . $b['id'] . '"';
            if ($b['id'] == $active) {
                $str.=' selected="selected"';
            }
            $str.= $disabled . '>' . $b['branchname'] . '</option>';
        endforeach;
        $str.= '</select>';
        return $str;
    }

    public function ComboBranchDisabled($branchactive = null) {
        $branchList = Branch::model()->findAll("active = '1'");

        if (!empty($branchactive)) {
            $branch = Yii::app()->session['branch'];
            if ($branch == "99") {
                $active = "";
                $disabled = "";
            } else {
                $active = $branch;
                $disabled = 'disabled="disabled"';
            }
        } else {
            $active = $branchactive;
            $disabled = "";
        }



        $str = "";
        $str.='<select id="branch" class="form-control">';
        foreach ($branchList as $b):
            $str.= '<option value="' . $b['id'] . '"';
            if ($b['id'] == $active) {
                $str.=' selected="selected"';
            }
            $str.= $disabled . '>' . $b['branchname'] . '</option>';
        endforeach;
        $str.= '</select>';
        return $str;
    }

}
