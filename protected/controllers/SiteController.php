<?php

class SiteController extends Controller {

    public $layout = 'template_backend';

    /**
     * Declares class-based actions.
     */
    //public $layout = "template_backend";

    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'

        $rs = $this->CountService();
        $data['countservice'] = $rs['c']['humen'];
        $data['countvisit'] = $rs['c']['visit'];
        
        $this->render('index', $data);
    }

    function CountService() {
        $branch = Yii::app()->session['branch'];
        if ($branch == "99") {
            $wherebranch = " 1=1";
        } else {
            $wherebranch = "s.branch = '1'";
        }
        $sql = "SELECT COUNT(DISTINCT(s.patient_id)) AS total
                    FROM service s 
                    WHERE $wherebranch ";
        $rs = Yii::app()->db->createCommand($sql)->queryRow();
        $humen = $rs['total'];

        $sqlvisit = "SELECT COUNT(*) AS total
                    FROM service s 
                    WHERE $wherebranch ";
        $rsvisit = Yii::app()->db->createCommand($sqlvisit)->queryRow();
        $visit = $rsvisit['total'];
        $data['c'] = array("humen" => $humen, "visit" => $visit);
        return $data;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $model = new LoginForm;
        $Masuser = new Masuser();
        $role = new RoleBranch();
        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
            //$this->redirect(Yii::app()->user->returnUrl);
                if (!Yii::app()->user->isGuest) {
                    $Profile = $Masuser->GetProfile();
                    $user_id = $Profile['id'];
                    $status = $Masuser->find("user_id = '$user_id'")['status'];
                    $branch = $role->find("user_id = '$user_id' ");
                    Yii::app()->session['status'] = $status;
                    Yii::app()->session['branch'] = $branch['branch_id'];

                    $loglogin = array("user_id" => $user_id, "branch" => $branch['branch_id'], "date" => date("Y-m-d H:i:s"));
                    Yii::app()->db->createCommand()
                            ->insert("loglogin", $loglogin);

                    $this->redirect(array('site/index'));
                } else {
                    $this->renderPartial('login', array('model' => $model));
                }
        }
        // display the login form
        $this->renderPartial('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        //$this->redirect(array('frontend/main'));
        $this->redirect(Yii::app()->user->returnUrl);
    }

    public function actionAbout() {
        $rs = Yii::app()->db->createCommand()
                ->select('*')
                ->from('about')
                ->queryRow();

        $data['about'] = $rs;
        $this->render("//main/about", $data);
    }

    public function actionSetactivemenu() {
        $menu = Yii::app()->request->getPost('menu');
        Yii::app()->session['leftmenu'] = $menu;
    }

}
