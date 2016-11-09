
<script type="text/javascript">
    $(document).ready(function () {
        load_data();
        $('form').on('submit', function (e) {
            e.preventDefault();
            var url = "<?php echo Yii::app()->createUrl('backend/payment/save_payment') ?>";
            var data = $("form").serialize();

            $.ajax({
                type: 'post',
                url: url,
                data: data,
                success: function () {
                    load_data();
                }
            });
        });
    });

    function delete_payment(id) {
        var r = confirm("คุณแน่ใจหรือไม่ที่จะลบ ...?");
        var url = "<?php echo Yii::app()->createUrl('backend/payment/delete_payment') ?>";
        var data = {id: id}

        if (r == true) {

            $.post(url, data, function (success) {
                load_data();
            });
        }
    }

    function load_data() {
        $("#load_data").html('<br/><center><i class="fa fa-spinner fa-spin fa-3x"></i></center><br/>');
        var url = "<?php echo Yii::app()->createUrl('backend/payment/load_data') ?>";
        var data = "";
        $.post(url, data, function (result) {
            $("#load_data").html(result);
        });
    }
</script>

<?php
$title = "ช่องทางการชำระเงิน";
$this->breadcrumbs = array($title,);
?>

<form>
    <div class="panel panel-default">
        <div class="panel-heading"><i class="fa fa-money"></i> ช่องทางการชำระเงิน</div>
        <div class="panel-body">
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <label>เลือกธนาคาร</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <select id="bank_id" name="bank_id" class="form-control input-sm" required>
                            <option value="">เลือกธนาคาร</option>
                            <?php foreach ($bank as $b): ?>
                                <option value="<?php echo $b['id'] ?>"><?php echo $b['bank_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <label>ชื่อเจ้าของบัญชี</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control input-sm" id="bookbank_name" name="bookbank_name" required/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <label>เลขบัญชีธนาคาร</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control input-sm" id="bookbank_number" name="bookbank_number" required/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <label>สาขาธนาคาร</label>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <input type="text" class="form-control input-sm" id="bank_branch" name="bank_branch" required/>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> บันทึก</button>
            <button type="reset" class="btn btn-danger"><i class="fa fa-remove"></i> ยกเลิก</button>
        </div>
    </div>
</form>

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-book"></i> บัญชีธนาคาร</div>
    <div id="load_data"></div>
</div>
