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


<div class="panel panel-info">
    <div class="panel-heading" id="heading-panel">
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
                <br/><br/>
                <div class="well" style="border-radius:0px; text-align: left; padding-left: 30px; padding-bottom: 0px;">
                    <div style=" padding-left: 30px;">
                        <input type="file" name="file_upload" id="file_upload" />
                    </div>
                    <p id="font-16" style=" color: #ff0000; text-align: center; margin-bottom: 0px;">(ไม่เกิน 2MB)</p>
                </div>
            </center>
            <div id="font-18" style="color: #ff6600;">
                <font id="font-rsu-20" style=" color: #000020;"><?php echo $model['alias']; ?></font><br/>
                เป็นสมาชิกเมื่อ <br/><?php echo $config->thaidate($model['create_date']); ?>
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

                เบอร์โทรศัพท์ <p class="label" id="font-18"><?php
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
                    echo Position::model()->find("id = '$position' ")['position'];
                    ?></p><br/>
                เงินเดือน <p class="label" id="font-18"><?php
                    if (isset($model['salary'])) {
                        echo number_format($model['salary'], 2);
                    } else {
                        echo "-";
                    }
                    ?> </p>บาท<br/>

                ข้อมูลอัพเดทวันที่ <p class="label" id="font-18"><?php
                    if (isset($model['d_update'])) {
                        echo $config->thaidate($model['d_update']);
                    } else {
                        echo "-";
                    }
                    ?></p><br/>
                <br/>

                <!--
                ที่อยู่ <br/>
                <div class="btn btn-default btn-sm pull-right" id="font-rsu-14" onclick="edit_address_profile();">แก้ไขที่อยู่</div>
                <ul style=" padding-top: 5px;">
                -->
                <?php
                /*
                  echo "<li>เลขที่ ";
                  if (isset($model['number'])) {
                  echo ($model['number']);
                  } else {
                  echo "-";
                  } "</li>";
                  echo "<li>อาคาร ";
                  if (isset($model['building'])) {
                  echo ($model['building']);
                  } else {
                  echo "-";
                  } "</li>";
                  echo "<li>ชั้น ";
                  if (isset($model['class'])) {
                  echo ($model['class']);
                  } else {
                  echo "-";
                  }
                  echo " ห้อง ";
                  if (isset($model['room'])) {
                  echo ($model['room']);
                  } else {
                  echo "-";
                  } "</li>";
                  echo "<li>ต. ";
                  if (isset($model['tambon_name'])) {
                  echo ($model['tambon_name']);
                  } else {
                  echo "-";
                  }
                  echo " &nbsp;&nbsp;อ. ";
                  if (isset($model['ampur_name'])) {
                  echo ($model['ampur_name']);
                  } else {
                  echo "-";
                  }
                  echo " &nbsp;&nbsp;จ. ";
                  if (isset($model['changwat_name'])) {
                  echo ($model['changwat_name']);
                  } else {
                  echo "-";
                  } "</li>";
                  echo "<li>รหัสไปรษณีย์ ";
                  if (isset($model['zipcode'])) {
                  echo ($model['zipcode']);
                  } else {
                  echo "-";
                  } "</li>";
                 * 
                 */
                ?>
                </ul>
            </div>

            <div class="row" style=" padding: 5px;">
                <div class="col-lg-4">
                    <div class="btn btn-success btn-block">
                        <h3><?php echo number_format($Selltotalyearnow) ?></h3><hr/>
                        <h4>ยอดขายปีนี้ </h4>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="btn btn-warning btn-block">
                        <h3><?php echo number_format($Selltotallastyear) ?></h3><hr/>
                        <h4>ยอดขายปีที่แล้ว </h4>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="sell" style=" height: 150px;"></div>
                </div>
            </div>

        </div>

    </div>

    <div class="row" style=" padding: 15px;">
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">ประวัติการขายสินค้า</div>
                <div id="sellmonth" style=" height: 250px;"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading">ประวัติการเข้าใช้งานระบบ</div>
                <div id="loginsystem" style=" height: 250px;"></div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#file_upload').uploadify({
            'buttonText': 'เลือกรูปภาพ ...',
            //'swf ': '<?//php echo Yii::app()->baseUrl; ?>/lib/uploadify/uploadify.swf',
            'swf': '<?php echo Yii::app()->baseUrl . "/lib/uploadify/uploadify.swf?preventswfcaching=1442560451655"; ?>',
            'uploader': '<?php echo Yii::app()->createUrl('employee/save_upload', array('pid' => $model['pid'])) ?>',
            'auto': true,
            'fileSizeLimit': '2MB',
            'fileTypeExts': ' *.jpg; *.png',
            'uploadLimit': 1,
            'onUploadSuccess': function (data) {
                window.location.reload();
            }
        });
    });

    function deletemployee(id) {
        var r = confirm("คุณแน่ใจหรือไม่ ... ข้อมูลที่เกี่ยวข้องกับพนักงานจะถูกลบทั้งหมด ... ?");
        if (r == true) {
            var url = "<?php echo Yii::app()->createUrl('employee/delete') ?>";
            var data = {id: id};
            $.post(url, data, function (success) {
                window.location.reload();
            });
        }
    }


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
                    data: [<?php echo $Selltotalyearnow ?>, <?php echo $Selltotallastyear ?>]
                }]
        });
    });


    $(function () {
        Highcharts.chart('sellmonth', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ยอดขายปี <?php echo $year ?>'
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
                    text: 'จำนวนเงิน'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'ยอดขาย: <b>{point.y:.1f} บาท</b>'
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
                        format: '{point.y:.1f}', // one decimal
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
                text: 'จำนวนเข้าใช้งาน <?php echo $year ?>'
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
</script>

