<?php
/* @var $this MasuserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'กำหนดสิทธิ์ผู้ใช้งาน',
);

$system = new Configweb_model();
$MasuserModel = new Masuser();
?>

<div class="panel panel-default" style=" margin-bottom: 0px;">
    <div class="panel-heading" style=" padding-bottom: 15px; padding-right: 5px; background: none;">
        <i class="fa fa-users"></i> เลือกผู้ใช้งาน  <span id="loading"></span>
    </div>
    <div class="panel-body" style="padding: 10px;">
        <div class="row" style=" margin-top: 10px;">
            <div class="col-xs-3 col-lg-1 col-md-1" style=" text-align: center;"><label>สาขา*</label></div>
            <div class="col-xs-5 col-lg-3 col-md-3">
                <?php
                $this->widget('booster.widgets.TbSelect2', array(
                    'name' => 'branch',
                    'id' => 'branch',
                    'data' => CHtml::listData($BranchList, 'id', 'branchname'),
                    'value' => $branch,
                    'options' => array(
                        'placeholder' => 'เลือกสาขา',
                        'width' => '100%',
                        'allowClear' => true,
                    )
                        )
                );
                ?>
            </div>
            <div class="col-xs-3 col-md-3 col-lg-3">
                <button type="button" class="btn btn-default" onclick="getdata();">ค้นหา</button>
            </div>
        </div>
        <hr/>

        <div id="showdata"></div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        getdata();
    });

    function getdata() {
        var loading = '<i class="fa fa-spinner fa-spin fa-fw"></i>';
        $("#loading").html(loading);
        var branch = $("#branch").val();
        var url = "<?php echo Yii::app()->createUrl('masuser/getdataprilege') ?>";
        var data = {branch: branch};
        $.post(url, data, function (datas) {
            $("#loading").html('');
            $("#showdata").html(datas);
        });
    }
</script>





