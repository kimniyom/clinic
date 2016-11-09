<script type="text/javascript">
    $(document).ready(function () {
        $("#article").DataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            "iDisplayLength": 20, // กำหนดค่า default ของจำนวน record 
            "bFilter": true, // แสดง search box
            "sort": false
            //"sScrollY": "400px", // กำหนดความสูงของ ตาราง
        });
    });
</script>

<?php
$this->breadcrumbs = array(
    'บทความ',
);
?>

<table class="table table-striped" id="article">
    <thead>
        <tr>
            <th><i class="fa fa-newspaper-o"></i> ทั้งหมด</th>
            <th style="text-align: right;">
                <a href="<?php echo Yii::app()->createUrl('backend/article/create') ?>">
                    <button type="button" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> สร้างบทความ</button></a>
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($article as $rs) {
            if (!empty($rs['images'])) {
                $img = "uploads/article/" . $rs['images'];
            } else {
                $img = "images/No-image.jpg";
            }
            ?>
            <tr>
                <td>
                    <img class="media-object img-responsive" src="<?php echo Yii::app()->baseUrl; ?>/<?php echo $img ?>" style=" max-width: 50px;">
                </td>
                <td>
                    <a href="<?php echo Yii::app()->createUrl('backend/article/view/id/' . $rs['id']) ?>">
                        <h4 class="media-heading"><?php echo $rs['title'] ?></h4></a>
                    <font id="font-glay">
                    <i class="fa fa-user"></i> <?php echo $rs['name'] . ' ' . $rs['lname'] ?>
                    <i class="fa fa-calendar"></i> <?php echo $rs['create_date'] ?>
                    </font>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
