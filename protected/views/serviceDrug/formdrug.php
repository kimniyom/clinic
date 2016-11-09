<div class="panel panel-danger">
    <div class="panel-heading">
        <i class="fa fa-medkit"></i> ยา / สินค้า
        <button type="button" class="btn btn-success btn-xs pull-right"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
    </div>
    <div class="panel-body">
        <label>สาขา</label>
        <?php
        $BranchModel = new Branch();
        echo $BranchModel->ComboBranch();
        ?>
    </div>
</div>