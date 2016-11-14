
<div class="panel panel-danger">
    <div class="panel-heading">
        <i class="fa fa-medkit"></i> ยา / สินค้า
        <button type="button" class="btn btn-success btn-xs pull-right" onclick="checkstock()"><i class="fa fa-save"></i> เพิ่มข้อมูล</button>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                ประเภทสินค้า
                <select id="type" class="form-control" onchange="getproduct(this.value)">
                    <option value="">== เลือกประเภท ==</option>
                    <?php foreach ($type as $rs): ?>
                        <option value="<?php echo $rs['type_id'] ?>"><?php echo $rs['type_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-lg-6 col-md-6">
                สินค้า
                <div id="_product">
                    <select id="product" class="form-control">
                        <option value=""> == เลือกสินค้า == </option>
                    </select>
                </div>
            </div>
            <div class="col-lg-2 col-md-2">
                จำนวน
                <input type="text" class="form-control" id="number" onkeypress="return chkNumber()" maxlength="3" value="1"/>
            </div>
        </div>
        <label>สาขา</label>
        <?php
        $BranchModel = new Branch();
        echo $BranchModel->ComboBranch();
        ?>
        
        <hr/>
        <div id="druglist"></div>
    </div>
</div>

<script type="text/javascript">
    loaddruglist();
    function getproduct(type) {
        var data = {type: type};
        var url = "<?php echo Yii::app()->createUrl('servicedrug/getproduct') ?>";
        $.post(url, data, function (result) {
            $("#_product").html(result);
        });

    }

    function checkstock() {
        var url = "<?php echo Yii::app()->createUrl('backend/stock/checkstockproduct') ?>";
        var product = $("#product").val();
        var number = $("#number").val();
        var branch = $("#branch").val();

        if (product == "") {
            alert("กรุณาเลือกสินค้า / ยา");
            return false;
        }
        var data = {product: product, number: number, branch: branch};
        $.post(url, data, function (datas) {
         
            if (datas === '1') {
                adddrug(product, number, branch);
            } else {
                alert("จำนวนคงเหลือไม่พอต่อการขาย ...");
                return false;
            }
        });
    }

    function adddrug(product, number, branch) {
        var url = "<?php echo Yii::app()->createUrl('servicedrug/adddrug') ?>";
        var patient_id = $("#patient_id").val();
        var seq = "<?php echo $seq ?>";
        var diagcode = $("#diagcode").val();
  
        var data = {patient_id: patient_id,seq: seq, product: product, number: number, branch: branch, diagcode: diagcode};
        $.post(url, data, function (datas) {
            GetformDrug();
        });
    }
    
    function loaddruglist(){
        var url = "<?php echo Yii::app()->createUrl('servicedrug/druglist') ?>";
        var seq = "<?php echo $seq ?>";
        var data = {seq: seq};
        $.post(url, data, function (datas) {
            $("#druglist").html(datas);
        });
    }

</script>