
<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'ข้อมูลบริษัท',
);

$product_model = new Product();
?>

<h4>ที่อยู่ / ข้อมูลติดต่อ</h4>
<div class="row" style="margin:0px;;">
    <div class="col-lg-2 col-md-2 col-sm-6" style="text-align:center;">
        <?php if (empty($company['logo'])) { ?>
            <img src="<?php echo Yii::app()->baseUrl; ?>/images/No_image_available.jpg" width="50" style="margin: 0px;"/>
        <?php } else { ?>
            <img src="<?php echo Yii::app()->baseUrl; ?>/uploads/logo/<?php echo $company['logo'] ?>" style="margin: 0px; max-height:200px;"/>
        <?php } ?>
        <br/>
        <button type="button" class="btn btn-default" onclick="javascript:$('#uploadprofile').modal();"><i class="fa fa-photo"></i> เปลี่ยนรูปภาพ</button>
                <p id="font-16" style=" color: #ff0000; text-align: center; margin-bottom: 0px;">(ไม่เกิน 2MB)</p>
        <!--
        <input id="Filedata" name="Filedata" type="file" multiple="true">
    -->
    </div>
    
</div>
<hr/>
<div class="row" style="margin:0px;;">
<div class="col-lg-10 col-md-10">
        บริษัท : <?php echo $company['companyname'] ?><br/>
        ที่อยู่ : <?php echo $company['address'] ?><br/>
        ผู้จัดการ : <?php echo $company['memager'] ?><br/>
        เบอร์โทร : <?php echo $company['tel'] ?><br/> 
        เลขประจำตัวผู้เสียภาษี : <?php echo $company['tax'] ?><br/>
        <a href="<?php echo Yii::app()->createUrl('companycenter/update', array('id' => 1)) ?>" class="btn btn-warning">
            <i class="fa fa-pencil"></i> แก้ไข</a>
    </div>
</div>

<!--
<h4>สินค้า</h4>
<div class="row">
-->
    <!--
    <div class="col-lg-2 col-md-2">
        <a href="<?//php echo Yii::app()->createUrl('centerstoreproduct/index') ?>">
            <button type="button" class="btn btn-success btn-block">
                <img src="<?//= Yii::app()->baseUrl; ?>/images/box-icon.png"/><br/>
                คลังสินค้า
            </button></a>
    </div>
    -->
    <!--
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6" style=" margin-bottom: 10px;">
        <a href="<?php //echo Yii::app()->createUrl('centerstockproduct/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?php //echo Yii::app()->baseUrl; ?>/images/Product-sale-report-icon.png"/><br/>
                รายการสินค้า
            </button></a>
    </div>

    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6" style=" margin-bottom: 10px;">
        <a href="<?php //echo Yii::app()->createUrl('unit/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?php //echo Yii::app()->baseUrl; ?>/images/unit-icon.png"><br/>
                หน่วยนับ สินค้า
            </button></a>
    </div>
    
</div>
<hr/>
<h4>วัตถุดิบ</h4>
<div class="row">
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6" style=" margin-bottom: 10px;">
        <a href="<?php //echo Yii::app()->createUrl('centerstockitem/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?php //echo Yii::app()->baseUrl; ?>/images/store-icon.png"/><br/>
                สต๊อกวัตถุดิบ
            </button></a>
    </div>
    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6" style=" margin-bottom: 10px;">
        <a href="<?php //echo Yii::app()->createUrl('centerstockitemname/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?php //echo Yii::app()->baseUrl; ?>/images/product-icon.png"/><br/>
                รายการวัตถุดิบ
            </button></a>
    </div>

    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6" style=" margin-bottom: 10px;">
        <a href="<?php //echo Yii::app()->createUrl('centerstockunit/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?php //echo Yii::app()->baseUrl; ?>/images/unit-icon.png"><br/>
                หน่วยนับ วัตถุดิบ
            </button></a>
    </div>

    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6" style=" margin-bottom: 10px;">
        <a href="<?php //echo Yii::app()->createUrl('centerstockcompany/index') ?>">
            <button type="button" class="btn btn-default btn-block">
                <img src="<?php //echo Yii::app()->baseUrl; ?>/images/company-building-icon.png"><br/>
                บริษัทสั่งซื้อวัตถุดิบ
            </button></a>
    </div>
    -->
    <!--
</div>
-->

<div class="modal fade" tabindex="-1" role="dialog" id="uploadprofile">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form id="upload" method="post" action="<?= Yii::app()->createUrl('companycenter/upload') ?>" enctype="multipart/form-data">
                    <div id="drop">
                        เลือกรูปภาพ<br/>
                        <a class="btn btn-primary"><i class="fa fa-picture-o"></i> Browse</a>
                        <input type="file" name="upl" />
                    </div>

                </form>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    $(function () {

        var ul = $('#upload ul');
        $('#drop a').click(function () {
            // Simulate a click on the file input button
            // to show the file browser dialog
            $(this).parent().find('input').click();
        });

        // Initialize the jQuery File Upload plugin
        $('#upload').fileupload({

            // This element will accept file drag/drop uploading
            dropZone: $('#drop'),

            // This function is called when a file is added to the queue;
            // either via the browse button, or via drag/drop:

            add: function (e, data) {

                var tpl = $('<li class="working"><input type="text" value="0" data-width="36" data-height="36"' +
                        ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

                // Append the file name and file size
                //data.files[0].name
                tpl.find('p').text("")
                        .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

                // Add the HTML to the UL element
                data.context = tpl.appendTo(ul);

                // Initialize the knob plugin
                tpl.find('input').knob();

                // Listen for clicks on the cancel icon
                tpl.find('span').click(function () {

                    if (tpl.hasClass('working')) {
                        jqXHR.abort();
                    }

                    tpl.fadeOut(function () {
                        tpl.remove();
                    });

                });

                //Automatically upload the file once it is added to the queue
                //var jqXHR = data.submit();

                var jqXHR = data.submit()
                        .success(function (result, textStatus, jqXHR) {
                            if (result == "error") {
                                data.context.addClass('error');
                            }

                        })
                        //.error(function (jqXHR, textStatus, errorThrown) {alert(jqXHR); return false;})
                        .complete(function (result, textStatus, jqXHR) {
                            window.location.reload();
                        });
            },

            progress: function (e, data) {
                var type = data.files[0].type;
                var size = data.files[0].size;

                if (type == "image/jpeg" && size <= "1000000") {
                    // Calculate the completion percentage of the upload
                    var progress = parseInt(data.loaded / data.total * 100, 10);

                    // Update the hidden input field and trigger a change
                    // so that the jQuery knob plugin knows to update the dial
                    data.context.find('input').val(progress).change();

                    if (progress == 100) {
                        data.context.removeClass('working');
                    } else {
                        data.context.addClass('error');
                    }
                } else {
                    data.context.addClass('error');
                }

            },

            fail: function (e, data) {
                // Something has gone wrong!
                data.context.addClass('error');
            }

        });

        // Prevent the default action when a file is dropped on the window
        $(document).on('drop dragover', function (e) {
            e.preventDefault();
        });

        // Helper function that formats the file sizes
        function formatFileSize(bytes) {
            if (typeof bytes !== 'number') {
                return '';
            }

            if (bytes >= 1000000000) {
                return (bytes / 1000000000).toFixed(2) + ' GB';
            }

            if (bytes >= 1000000) {
                return (bytes / 1000000).toFixed(2) + ' MB';
            }

            return (bytes / 1000).toFixed(2) + ' KB';
        }

    });
</script>


