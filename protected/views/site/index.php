<?php
$config = new Configweb_model();
$month = date("m");
?>
<script>
    $(document).ready(function () {
        $(".breadcrumb").hide();
        $("#m-left").hide();
    });
</script>
<div id="p-box">
    <div class="row" style=" margin: 0px; padding: 0px;">
        <div class="col-md-12 col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-cog"></i> เมนู</div>
                <div class="panel-body">
                    <div class="row">
                        <?php
                        $MenuModel = new Menu();
                        $UserModel = new Masuser();
                        $product_model = new Backend_product();
                        $AppointModel = new Appoint();
                        $Profile = $UserModel->GetProfile();
                        $MenuSystem = $MenuModel->Getrolemenu($Profile['user_id']);
                        $alet = new Alert();
                        $i = 0;
                        foreach ($MenuSystem as $mn):
                            $linkmenu = $mn['link'];
                            $icon = $mn['icon'];
                            $i ++;
                            ?>
                            <?php if ($mn['id'] == $mn['menu_id']) { ?>
                                <div class="col-md-3 col-lg-3 col-xs-6" style=" margin-bottom: 20px;">
                                    <a href="<?php echo Yii::app()->createUrl($linkmenu) ?>" onclick="setactivemenu('<?php echo "M" . $i ?>')">
                                        <div class="btn btn-default btn-block">
                                            <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $icon ?>"
                                                 height="48px"/><br/>
                                                 <?php echo $mn['menu'] ?>
                                        </div>
                                    </a>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-3 col-lg-3 col-xs-6" style=" margin-bottom: 20px;opacity: 0.4;">
                                    <div class="btn btn-default btn-block disabled">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/<?php echo $icon ?>"
                                             height="48px"/><br/>
                                             <?php echo $mn['menu'] ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-4">
            <?php if (Yii::app()->session['branch'] != '99') { ?>
                <div class="panel panel-warning">
                    <div class="panel-heading"><i class="fa fa-bell-o"></i> แจ้งเตือน</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xs-6" style=" margin-bottom: 20px;">
                                <a href="<?php echo Yii::app()->createUrl('backend/stock/expireproduct') ?>">
                                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                                        <?php echo $alet->Countalertproduct(Yii::app()->session['branch']); ?>
                                    </span>
                                    <div class="btn btn-default btn-block">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png" height="48px"/><br/>
                                        สินค้าใกล้หมด
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-6" style=" margin-bottom: 20px;">
                                <a href="<?php echo Yii::app()->createUrl('backend/stock/expireitem') ?>">
                                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                                        <?php echo $alet->CountAlertExpire(); ?>
                                    </span>
                                    <div class="btn btn-default btn-block">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png"
                                             height="48px" /><br/>
                                        สินค้าใกล้หมดอายุ
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-6">
                                <a href="<?php echo Yii::app()->createUrl('backend/stock/expire') ?>">
                                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                                        <?php echo $alet->CountExpire(); ?>
                                    </span>
                                    <div class="btn btn-default btn-block">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png"
                                             height="48px" /><br/>
                                        สินค้าหมดอายุ
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-6" style=" margin-bottom: 20px;">
                                <a href="<?php echo Yii::app()->createUrl('appoint/appointover') ?>">
                                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                                        <?php echo $AppointModel->Countover(); ?>
                                    </span>
                                    <div class="btn btn-default btn-block">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png" height="48px"/><br/>
                                        นัดลูกค้า
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xs-12" style=" margin-bottom: 20px;">
                                <a href="<?php echo Yii::app()->createUrl('repair') ?>">
                                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                                        <?php echo $alet->AlertRepair(); ?>
                                    </span>
                                    <div class="btn btn-default btn-block">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png"
                                             height="48px" /><br/>
                                        แจ้งเตือนซ่อม - บำรุง
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="panel panel-warning">
                    <div class="panel-heading"><i class="fa fa-bell-o"></i> แจ้งเตือน</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-xs-6" style=" margin-bottom: 20px;">
                                <?php
                                $itemalert = $alet->Alertcenterstockitem();
                                ?>
                                <a href="<?php echo Yii::app()->createUrl('centerstockitem/listalertcenterstockitem') ?>">
                                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: <?php echo $itemalert > 0 ? "#ff0033" : "#eeeeee" ?>;">
                                        <?php echo $itemalert ?>
                                    </span>
                                    <div class="btn btn-default btn-block">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png" height="48px"/><br/>
                                        วัตถุดิบใกล้หมด
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-6" style=" margin-bottom: 20px;">
                                <a href="<?php echo Yii::app()->createUrl('centerstockitem/listexpirecenterstockitem') ?>">
                                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                                        <?php echo $alet->Alertexpirecenterstockitem(); ?>
                                    </span>
                                    <div class="btn btn-default btn-block">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png"
                                             height="48px" /><br/>
                                        วัตถุดิบหมดอายุ
                                    </div>
                                </a>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xs-12" style=" margin-bottom: 20px;">
                                <a href="<?php echo Yii::app()->createUrl('repair') ?>">
                                    <span class="badge" style=" position: absolute;top:0px; right: 0px; background: #ff0033;">
                                        <?php echo $alet->AlertRepair(); ?>
                                    </span>
                                    <div class="btn btn-default btn-block">
                                        <img src="<?php echo Yii::app()->baseUrl; ?>/images/alert-icon.png"
                                             height="48px" /><br/>
                                        แจ้งเตือนซ่อม - บำรุง
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="panel panel-info">
                <div class="panel-heading">การให้บริการ เดือน <?php echo $config->MonthFullArray()[(int) $month] ?></div>
                <div class="panel-body" style=" padding: 10px;">
                    <div id="chartstatistics" style=" height: 80px;"></div>
                </div>
            </div>
        </div>
    </div>


</div>

<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var screen = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (screen - 60);
        $("#p-box").css({'height': screenfull, 'overflow': 'auto', 'padding-bottom': '25px'});
        //$("#patientbox").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF'});
        //$("#boxorders").css({'height': screenfull, 'background': '#00bca5', 'color': '#FFFFFF', 'overflow': 'auto', 'padding-left': '10px'});

    }

    $(function () {
        Highcharts.chart('chartstatistics', {
            chart: {
                type: 'bar'
            },
            title: {
                text: null
            },
            subtitle: {
                text: null
            },
            xAxis: {
                categories: ['คน', 'ครั้ง'],
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
                valueSuffix: ''
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                    name: 'จำนวน',
                    colorByPoint: true,
                    data: [<?php echo $countservice ?>, <?php echo $countvisit ?>]
                }]
        });
    });
</script>
