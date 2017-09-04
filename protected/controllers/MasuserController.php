<?php

class MasuserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'template_backend';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'admin', 'getrole', 'setbranch', 'deletebranch','profile','getdata'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id, $user_id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'user_id' => $user_id
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Masuser;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Masuser'])) {
            $model->attributes = $_POST['Masuser'];
            $model->password = md5($_POST['Masuser']['password']);
            $model->create_date = date("Y-m-d H:i:s");
            $model->d_update = date("Y-m-d H:i:s");
            $model->flag = "0";
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id,'user_id' => $model->user_id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id, $user_id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Masuser'])) {
            $model->attributes = $_POST['Masuser'];
            $model->password = md5($_POST['Masuser']['password']);
            $model->d_update = date("Y-m-d H:i:s");
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id, 'user_id' => $user_id));
        }

        $this->render('update', array(
            'model' => $model,
            'user_id' => $user_id,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $branch = Yii::app()->session['branch'];
        $data['branchModel'] = Branch::model()->find('id=:id', array(':id' => $branch));
        $data['branch'] = $branch;
        if ($branch == "99") {
            $BranchList = Branch::model()->findAll();
        } else {
            $BranchList = Branch::model()->findAll("id = '$branch'");
        }
        $data['BranchList'] = $BranchList;
        $this->render('index',$data);
    }

    public function actionGetdata(){
        $branch_id = Yii::app()->request->getPost('branch');
        $Model = new Masuser();
        $data['user'] = $Model->GetUserBranch($branch_id);
        $this->renderPartial('datauser',$data);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Masuser('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Masuser']))
            $model->attributes = $_GET['Masuser'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Masuser the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Masuser::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Masuser $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'masuser-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionGetrole() {
        $user_id = Yii::app()->request->getPost('user_id');
        $sql = "SELECT r.id,b.branchname FROM role_branch r INNER JOIN branch b ON r.branch_id = b.id WHERE r.user_id = '$user_id' ";
        $data['branch'] = Yii::app()->db->createCommand($sql)->queryAll();

        $this->renderPartial('roleuser', $data);
    }

    public function actionSetbranch() {
        $user_id = Yii::app()->request->getPost('user_id');
        $branch = Yii::app()->request->getPost('branch');

        $Check = RoleBranch::model()->count("user_id = '$user_id' ");
        if ($Check <= 0) {
            $columns = array(
                "user_id" => $user_id,
                "branch_id" => $branch
            );
            Yii::app()->db->createCommand()
                    ->insert("role_branch", $columns);
        } else {
            $columns = array(
                //"user_id" => $user_id,
                "branch_id" => $branch
            );
            Yii::app()->db->createCommand()
                    ->update("role_branch", $columns, "user_id = '$user_id' ");
        }
    }

    public function actionDeletebranch() {
        $id = Yii::app()->request->getPost('id');

        Yii::app()->db->createCommand()
                ->delete("role_branch", "id = '$id' ");
    }

    public function actionProfile($id) {
        $year = date("Y");
        $Model = new Employee();
        $LogloginModel = new Loglogin();
        $sellmonth = $Model->Getsellmonth($id, $year);
        foreach ($sellmonth as $sm):
            //echo $sm['month_th']." ".$sm['total']."<br/>";
            $category[] = "['" . $sm['month_th'] . "'," . $sm['total'] . "]";
        endforeach;
        $categorys = implode(",", $category);
        
        $log = $LogloginModel->Getloglogin($id);
         foreach ($log as $lg):
            //echo $sm['month_th']." ".$sm['total']."<br/>";
            $loglogin[] = "['" . $lg['month_th'] . "'," . $lg['total'] . "]";
        endforeach;
        
        $loglogins = implode(",", $loglogin);
        $Selltotalyearnow = $Model->Selltotalyearnow($id);
        $Selltotallastyear = $Model->Selltotallastyear($id);
        $this->render('//masuser/profile', array(
            'model' => Employee::model()->find("id = '$id' "),
            'categorys' => $categorys,
            'year' => $year,
            'loglogin' => $loglogins,
            'Selltotalyearnow' => $Selltotalyearnow,
            'Selltotallastyear' => $Selltotallastyear,
        ));
    }

}
