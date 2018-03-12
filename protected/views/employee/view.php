<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs = array(
    'พนักงาน' => array('index'),
    $model->name,
);
$config = new Configweb_model();
$branchModel = new Branch();
?>
<style type="text/css">
    #font-18{
        color: #00cc00;
    }
</style>


<div class="panel panel-default" style=" margin: 0px; padding-bottom: 10px;">
    <div class="panel-heading">
        <i class="fa fa-user"></i> ID <?php echo $model['pid'] ?>
    </div>
    <div class="row" style="margin:0px;">
        <div class="col-md-3 col-lg-3" style="text-align: center;">
            <?php
            if (!empty($model['images'])) {
                $img_profile = "uploads/profile/" . $model['images'];
            } else {
                if ($model['sex'] == 'M') {
                    $img_profile = "images/Big-user-icon.png";
                } else if ($model['sex'] == 'F') {
                    $img_profile = "images/Big-user-icon-female.png";
                } else {
                    $img_profile = "images/Big-user.png";
                }
            }
            ?>
            <center>
                <img src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img_profile; ?>" class="img-responsive img-thumbnail" id="img_profile" style=" margin-top: 5px; max-height: 200px;"/>
                <br/>
                <button type="button" class="btn btn-default" onclick="javascript:$('#uploadprofile').modal();">เปลี่ยนรูปภาพ</button>
            </center>
            <div id="font-18" style="color: #ff6600;">
                <font id="font-rsu-20"><?php echo $model['alias']; ?></font><br/>
                วันที่ลงทะเบียน <br/><?php echo $config->thaidate($model['create_date']); ?>
            </div>
        </div>
        <div class="col-md-9 col-lg-9" style="padding-right: 0px;">
            <div class="well" style="margin: 5px; background: none;" id="font-20">
                <button type="button" class="btn btn-default btn-sm pull-right" id="font-rsu-14" 
                        onclick="deletemployee('<?php echo $model['id'] ?>')"><i class="fa fa-trash"></i> ลบ</button>
                <a href="<?php echo Yii::app()->createUrl('employee/update', array('id' => $model['id'])) ?>">
                    <button type="button" class="btn btn-default btn-sm pull-right" id="font-rsu-14"><i class="fa fa-pencil"></i> แก้ไข</button></a>

                ชื่อ - สกุล <p class="label" id="font-18"><?php echo $model['name'] . ' ' . $model['lname'] ?></p>
                ชื่อเล่น <p class="label" id="font-18"><?php
            if (isset($model['alias'])) {
                echo $model['alias'];
            } else {
                echo "-";
            }
            ?></p>
                เพศ <p class="label" id="font-18"><?php
                    if ($model['sex'] == 'M') {
                        echo "ชาย";
                    } else {
                        echo "หญิง";
                    }
            ?></p><br/>
                เกิดวันที่ <p class="label" id="font-18"><?php
                    if (isset($model['birth'])) {
                        echo $config->thaidate($model['birth']);
                    } else {
                        echo "-";
                    }
            ?></p>
                อายุ <p class="label" id="font-18"><?php
                    if (isset($model['birth'])) {
                        echo $config->get_age($model['birth']);
                    } else {
                        echo "-";
                    }
            ?></p>ปี <br/>
                อีเมล์ <p class="label" id="font-18"><?php
                    if (isset($model['email'])) {
                        echo $model['email'];
                    } else {
                        echo "-";
                    }
            ?></p>

                <br/>เบอร์โทรศัพท์ <p class="label" id="font-18"><?php
                    if (isset($model['tel'])) {
                        echo $model['tel'];
                    } else {
                        echo "-";
                    }
            ?></p><br/>
                สถานที่ปฏิบัติงาน <p class="label" id="font-18"><?php
                    echo "สาขา " . $branchModel->Getbranch($model['branch']);
            ?></p><br/>
                วันที่เข้าทำงาน <p class="label" id="font-18"><?php
                    if (isset($model['walking'])) {
                        echo $config->thaidate($model['walking']);
                    } else {
                        echo "-";
                    }
            ?></p><br/>
                ตำแหน่ง <p class="label" id="font-18"><?php
                    $position = $model['position'];
                    $posi = Position::model()->find("id = '$position' ");
                    echo $posi['position'];
            ?>

                </p>
                อายุงาน  <p class="label" id="font-18"> <?php echo $config->get_age($model['walking']); ?> </p> ปี
                <br/>
                เงินเดือน <p class="label" id="font-18"><?php
                    if (isset($model['salary'])) {
                        echo number_format($model['salary'], 2);
                    } else {
                        echo "-";
                    }
            ?> </p>บาท
                ค่าตำแหน่ง <p class="label" id="font-18"> <?php echo ($config->get_age($model['walking']) >= '3') ? number_format($posi['positionfree']) : '-'; ?> </p> บาท
                <br/>

                ข้อมูลอัพเดทวันที่ <p class="label" id="font-18"><?php
                    if (isset($model['d_update'])) {
                        echo $config->thaidate($model['d_update']);
                    } else {
                        echo "-";
                    }
            ?></p><br/>
                <br/>


                </ul>
            </div>

            <!--
            <div class="row" style=" padding: 0px; margin: 0px;">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style=" padding: 5px;">
                    <div class="well well-sm" style=" text-align: center; margin: 0px;">
                        <h3><?php //echo number_format($Selltotalyearnow)  ?></h3><hr/>
                        <h4>ยอดขายปีนี้ </h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style=" padding: 5px;">
                    <div class="well well-sm" style=" text-align: center; margin: 0px;">
                        <h3><?php //echo number_format($Selltotallastyear)  ?></h3><hr/>
                        <h4>ยอดขายปีที่แล้ว </h4>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div id="sell" style=" height: 150px;"></div>
                </div>
            </div>
            -->
        </div>

    </div>

    <div class="row" style=" padding: 0px; margin: 0px;">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default" style=" margin: 0px;">
                <div class="panel-heading">ผลงาน</div>
                <div id="sellmonth" style=" height: 250px;"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default" style=" margin: 0px;">
                <div class="panel-heading">ประวัติการเข้าใช้งานระบบ</div>
                <div id="loginsystem" style=" height: 250px;"></div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" tabindex="-1" role="dialog" id="uploadprofile">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form id="upload" method="post" action="<?php echo Yii::app()->createUrl('employee/save_upload', array('pid' => $model['pid'])) ?>" enctype="multipart/form-data">
                    <div id="drop">
                        เลือกรูปภาพ<br/>
                        <a class="btn btn-primary"><i class="fa fa-picture-o"></i> Browse</a>
                        <input type="file" name="upl" />
                    </div>

                    <ul style="">
                        <!-- The file uploads will be shown here -->
                    </ul>

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

    function deletemployee(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ... ข้อมูลที่เกี่ยวข้องกับพนักงานจะถูกลบทั้งหมด ... ?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('employee/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location = "<?php echo Yii::app()->createUrl('employee/index') ?>";
            });
        }
    }

    /*
     $(function () {
     Highcharts.chart('sell', {
     chart: {
     type: 'bar'
     },
     title: {
     text: ''
     },
     xAxis: {
     categories: ['ปีนี้', 'ปีที่แล้ว'],
     title: {
     text: null
     }
     },
     yAxis: {
     min: 0,
     title: {
     text: '',
     align: 'high'
     },
     labels: {
     overflow: 'justify'
     }
     },
     tooltip: {
     valueSuffix: ' บาท'
     },
     plotOptions: {
     bar: {
     dataLabels: {
     enabled: true
     }
     }
     },
     credits: {
     enabled: false
     },
     series: [{
     colorByPoint: true,
     name: 'ยอดขาย',
     data: [<?php //echo $Selltotalyearnow  ?>, <?php //echo $Selltotallastyear  ?>]
     }]
     });
     });
     */

    $(function () {
        Highcharts.chart('sellmonth', {
            chart: {
                type: 'column'
            },
            title: {
                text: '<span style="color:#eeeeee;"> ผลงานเดือนนี้ </span>'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวน'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'ยอดขาย: <b>{point.y:.0f} ครั้ง</b>'
            },
            credits: {
                enabled: false
            },
            series: [{
                    colorByPoint: true,
                    name: 'Population',
                    data: [<?php echo $categorys ?>
                        /*
                         ['Shanghai', 23.7],
                         ['Lagos', 16.1],
                         ['Istanbul', 14.2],
                         ['Karachi', 14.0],
                         ['Mumbai', 12.5],
                         ['Moscow', 12.1],
                         ['São Paulo', 11.8],
                         ['Beijing', 11.7],
                         ['Guangzhou', 11.1],
                         ['Delhi', 11.1],
                         ['Shenzhen', 10.5],
                         ['Seoul', 10.4] 
                         */
                    ],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y:.0f}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
        });
    });

    $(function () {
        Highcharts.chart('loginsystem', {
            chart: {
                type: 'line'
            },
            title: {
                text: '<span style="color:#eeeeee;">จำนวนเข้าใช้งาน <?php echo ($year + 543) ?> </span>'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวน'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'จำนวน: <b>{point.y} ครั้ง</b>'
            },
            credits: {
                enabled: false
            },
            series: [{
                    //colorByPoint: true,
                    name: 'เข้าใช้งาน',
                    data: [<?php echo $loglogin ?>
                        /*
                         ['Shanghai', 23.7],
                         ['Lagos', 16.1],
                         ['Istanbul', 14.2],
                         ['Karachi', 14.0],
                         ['Mumbai', 12.5],
                         ['Moscow', 12.1],
                         ['São Paulo', 11.8],
                         ['Beijing', 11.7],
                         ['Guangzhou', 11.1],
                         ['Delhi', 11.1],
                         ['Shenzhen', 10.5],
                         ['Seoul', 10.4] 
                         */
                    ],
                    dataLabels: {
                        enabled: true,
                        rotation: -90,
                        color: '#FFFFFF',
                        align: 'right',
                        format: '{point.y}', // one decimal
                        y: 10, // 10 pixels down from the top
                        style: {
                            fontSize: '13px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                }]
        });
    });

    function setboxview() {
        var w = window.innerWidth;
        if (w < 768) {
            $("#sell").css({'height': 'auto'});
        }
    }
</script>

