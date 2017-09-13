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

    </head>
    <body style=" background: #2a323b;">
        

        <div class="container" style="text-align: center; width: 300px; text-align: left; margin-top: 100px; background: #FFFFFF;">
            <div style=" margin: 10px; margin-bottom: 30px;">
                <h1 style=" text-align: center;">Login</h1>
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
                    <?php echo $form->labelEx($model, 'username'); ?>
                    <?php echo $form->textField($model, 'username', array('class' => 'form-control')); ?>
                    <p style="color: #ff0000;"><?php echo $form->error($model, 'username'); ?></p>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
                    <p style="color:#ff0000;"><?php echo $form->error($model, 'password'); ?></p>

                </div>

                <div class="row rememberMe">

                    <p></p>
                    <div style="color:#ff0000;"><?php echo $form->error($model, 'rememberMe'); ?></div>
                </div>

                <div class="row buttons">
                    <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary btn-block')); ?>
                </div>

                <?php $this->endWidget(); ?>
            </div>
        </div>
    </body>
</html>


