<?php

/**
 * This is the model class for table "appoint".
 *
 * The followings are the available columns in table 'appoint':
 * @property integer $id
 * @property integer $service_id
 * @property string $appoint
 * @property integer $branch
 * @property string $create_date
 */
class Appoint extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'appoint';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('service_id, branch', 'numerical', 'integerOnly' => true),
            array('appoint, create_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, service_id, appoint, branch, create_date', 'safe', 'on' => 'search'),
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
            'service_id' => 'รหัสให้บริการ',
            'appoint' => 'วันที่นัด',
            'branch' => 'นัดที่สาขา',
            'create_date' => 'วันที่บันทึกข้อมูล',
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
        $criteria->compare('service_id', $this->service_id);
        $criteria->compare('appoint', $this->appoint, true);
        $criteria->compare('branch', $this->branch);
        $criteria->compare('create_date', $this->create_date, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Appoint the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function GetBranch() {
        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $b = " AND 1=1";
        } else {
            $b = " AND a.branch = '$branch' ";
        }

        return $b;
    }

    public function Countover() {
        $Alert = new Alert();
        $alam = $Alert->Getalert()['alert_appoint'];
        $branch = $this->GetBranch();
        $sql = "SELECT COUNT(*) AS total
                    FROM appoint a 
                    WHERE DATEDIFF(a.appoint,NOW()) <= $alam AND a.status = '0' $branch";

        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        return $rs['total'];
    }

    public function Appointover() {
        $Alert = new Alert();
        $alam = $Alert->Getalert()['alert_appoint'];
        $branch = $this->GetBranch();
        $sql = "SELECT a.id,s.patient_id,a.appoint,a.branch,s.diagcode,p.oid,p.`name`,p.lname,c.tel,d.diagname,pr.pername,a.timeappoint,DATEDIFF(a.appoint,NOW()) AS over
                    FROM appoint a INNER JOIN service s ON a.service_id = s.id
                    INNER JOIN patient p ON s.patient_id = p.id
                    INNER JOIN patient_contact c ON p.id = c.patient_id
                    INNER JOIN diag d ON s.diagcode = d.diagcode
                    INNER JOIN pername pr ON p.oid = pr.oid
                    WHERE DATEDIFF(a.appoint,NOW()) <= $alam AND a.status = '0' $branch
                    ORDER BY a.create_date,a.timeappoint ASC ";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function AppointCurrent() {
        $branch = $this->GetBranch();
        $sql = "SELECT a.*,pr.pername,
		p.`name`,p.lname,p.card,p.images,s.diagcode,s.service_date,s.service_result,d.diagname,p.sex,p.birth
					FROM appoint a INNER JOIN service s ON a.service_id = s.id
					INNER JOIN patient p ON s.patient_id = p.id
					INNER JOIN pername pr ON p.oid = pr.oid
					INNER JOIN diag d ON s.diagcode = d.diagcode
					WHERE a.appoint = LEFT(NOW(),10) AND a.status = '0' $branch";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }

    public function AppointAll() {
        $branch = $this->GetBranch();
        $sql = "SELECT a.*,pr.pername,
		p.`name`,p.lname,p.card,p.images,s.diagcode,s.service_date,s.service_result,d.diagname,p.sex,p.birth,
                c.tel,c.email
					FROM appoint a INNER JOIN service s ON a.service_id = s.id
					INNER JOIN patient p ON s.patient_id = p.id
					INNER JOIN pername pr ON p.oid = pr.oid
					INNER JOIN diag d ON s.diagcode = d.diagcode
                                        INNER JOIN patient_contact c ON p.id = c.patient_id
					WHERE a.status = '0' $branch ORDER BY a.appoint,a.timeappoint asc";

        return Yii::app()->db->createCommand($sql)->queryAll();
    }
    
    public function Viewcarlendar($appoint = null,$type = null){
        $branch = Yii::app()->session['branch'];
        $sql = "SELECT a.*,p.pid,p.`name`,p.lname
                FROM appoint a INNER JOIN patient p ON a.patient_id = p.id
                WHERE a.`status` = '0' 
                AND a.appoint = '$appoint' 
                AND a.type = '$type' 
                AND a.branch = '$branch'
                ORDER BY a.id ASC";
        return Yii::app()->db->createCommand($sql)->queryAll();
    }

}
