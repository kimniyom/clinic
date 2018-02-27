<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php
        /* @var $this SiteController */
        /* @var $model LoginForm */
        /* @var $form CActiveForm  */

        $this->pageTitle = Yii::app()->name . ' - Login';
        $this->breadcrumbs = array(
            'Login',
        );

        $webconfig = new Configweb_model();
        $webname = $webconfig->get_webname();
        
        ?>
        <title><?php echo $webname ?></title>

        <style type="text/css">
            html,body{
                /*
                background:url('images/bg.jpg') fixed center no-repeat;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                */
                background: #2a323b;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/css/bootstrap-theme.css" media="screen, projection" />

    </head>
    <body style=" background: #2a323b;">
        <div class="container" style="text-align: center;text-align: left; margin-top: 30px;">
            <div class="row">
                <div class="col-xs-1 col-sm-4 col-md-4 col-lg-4"></div>
                <div class="col-xs-10 col-sm-4 col-md-4 col-lg-4">
                    <div class="well" style=" margin: 10px; margin-bottom: 30px;">
                        <center>
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bill-logo.png" style=" width: 100px;"/>
                        </center>
                        <h1 style=" text-align: center;">login</h1>
                        <h3 style=" text-align: center; color: #006666;"><?php echo $webname ?></h3>
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'login-form',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                        ));
                        ?>

                        <p class="note" style="text-align: center; color: #ff0000;">Fields with <span class="required">*</span> are required.</p>

                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo $form->labelEx($model, 'username'); ?>
                                <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                                <p style="color: #ff0000;"><?php echo $form->error($model, 'username'); ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <?php echo $form->labelEx($model, 'password'); ?>
                                <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
                                <p style="color:#ff0000;"><?php echo $form->error($model, 'password'); ?></p>
                            </div>
                        </div>
                        <hr/>
                        <div class="row buttons">
                            <div class="col-lg-12">
                                <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-success btn-block')); ?>
                            </div>
                        </div>

                        <?php $this->endWidget(); ?>
                    </div>
                    <div class="col-xs-1 col-sm-4 col-md-4 col-lg-4"></div>
                </div>
            </div>
        </div>
    </body>
</html>


