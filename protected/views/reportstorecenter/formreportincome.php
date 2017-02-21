<style type="text/css">
    #year{
        background: #FFFFFF;
        box-shadow: #cccccc 0px 3px 3px 0px;
        border-radius: 3px; 
    }
</style>
<?php $yearNow = date("Y") ?>
<div class="row">
    <div class="col-lg-2 col-md-2" style=" text-align: center; padding-top: 10px;">
        เลือกปี
    </div>
    <div class="col-lg-3 col-md-3">
        <select id="year" class="form-control">
            <?php for ($i = $yearNow; $i >= ($yearNow - 3); $i--): ?>
                <option value="<?php echo $i ?>"><?php echo ($i + 543) ?></option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-lg-2 col-md-2">
        <button type="button" class="btn btn-raised btn-info" style=" margin: 2px;" onclick="Getreport()">ตกลง</button>
    </div>
</div>
<hr/>
<div id="result"></div>

<script type="text/javascript">
    Getreport();
    function Getreport() {
        $("#result").html("Loading...");
        var url = "<?php echo Yii::app()->createUrl('reportstorecenter/reportincome') ?>";
        var year = $("#year").val();
        var data = {year: year};
        $.post(url, data, function (datas) {
            $("#result").html(datas);
        });
    }
</script>

