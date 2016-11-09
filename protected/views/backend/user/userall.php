<script type="text/javascript">
    $(document).ready(function () {
        $("#user").dataTable();
    });
</script>

<?php
$this->breadcrumbs = array(
    'สมาชิก'
);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        สมาชิก
    </div>
    <div class="panel-body table-responsive">
        <table class="table table-striped table-hover" id="user">
            <thead>
                <tr>
                    <th>#</th>
                    <th>รหัส</th>
                    <th>ชื่อ - สกุล</th>
                    <th>ชื่อเล่น</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>สาขา</th>
                    <th style=" text-align: center;">สถานะ</th>
                    <th style="text-align: center;">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($user as $rs): $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $rs['pid']; ?></td>
                        <td><?php echo $rs['name'] . ' ' . $rs['lname']; ?></td>
                        <td><?php echo $rs['alias']; ?></td>
                        <td><?php echo $rs['tel']; ?></td>
                        <td><?php echo $rs['branchname']?></td>
                        <td style="text-align: center;">

                        </td>
                        <td style="text-align: center;">
                            <!-- Small button group -->
                            <a href="<?php echo Yii::app()->createUrl('backend/user/detail&pid=' . $rs['pid']); ?>" title="ดูข้อมูล">
                                <div class="btn btn-primary btn-xs">
                                    <i class="fa fa-eye"></i>
                                </div></a>
                            <a href="" title="ลบ"><div class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></div></a>
                            <a href="" title="บล๊อค"><div class="btn btn-warning btn-xs"><i class="fa fa-ban"></i></div></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

