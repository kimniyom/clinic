<style type="text/css">
    table{
        background: #FFFFFF;
    }
</style>

<?php
/* @var $this ProductTypeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'คิวการรักษา',
);

$WebConfig = new Configweb_model();
?>

<button type="button" class="btn btn-success" onclick="loaddata()"><i class="fa fa-refresh"></i> Refresh</button>
<div class=" pull-right"><h4>วันที่ : <?php echo $WebConfig->thaidate(date("Y-m-d")) ?></h4></div>

<div id="resultservice" style=" margin-top: 10px;"></div>
<script type="text/javascript">
    loaddata();
    function loaddata() {
        var url = "<?php echo Yii::app()->createUrl('queue/seqdoctor') ?>";
        var data = {a: 1};
        $.post(url, data, function (datas) {
            $("#resultservice").html(datas);
        });
    }
</script>


