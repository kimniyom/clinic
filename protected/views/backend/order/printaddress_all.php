
<style type="text/css">
    body {
        font-family: "thsaraban","Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 16px;
        line-height: 1.42857143;
        color: #333;
        background: #fff;
        margin: 0px;
    }

    .well{
        background: none; width: 320px; border: #999999 dashed 1px; padding: 5px; float: left; margin-left: 10px;
        margin-bottom: 10px;
    }
</style>

<?php foreach ($result as $rs): ?>
    <div class="well">
        <b>ที่อยู่จัดส่ง</b><br/>
        &nbsp;&nbsp;คุณ <?php echo $rs['name'] . ' ' . $rs['lname']; ?><br/>
        <ul style="padding-top: 0px; margin: 0px;">
            <?php
            echo "<li>เลขที่ ";
            if (isset($rs['number'])) {
                echo ($rs['number']);
            } else {
                echo "-";
            } "</li>";
            echo "<li>อาคาร ";
            if (isset($rs['building'])) {
                echo ($rs['building']);
            } else {
                echo "-";
            } "</li>";
            echo "<li>ชั้น ";
            if (isset($rs['class'])) {
                echo ($rs['class']);
            } else {
                echo "-";
            }
            echo " ห้อง ";
            if (isset($rs['room'])) {
                echo ($rs['room']);
            } else {
                echo "-";
            } "</li>";
            echo "<li>ต. ";
            if (isset($rs['tambon_name'])) {
                echo ($rs['tambon_name']);
            } else {
                echo "-";
            }
            echo " &nbsp;&nbsp;อ. ";
            if (isset($rs['ampur_name'])) {
                echo ($rs['ampur_name']);
            } else {
                echo "-";
            }
            echo " &nbsp;&nbsp;จ. ";
            if (isset($rs['changwat_name'])) {
                echo ($rs['changwat_name']);
            } else {
                echo "-";
            } "</li>";
            echo "<li>รหัสไปรษณีย์ ";
            if (isset($rs['zipcode'])) {
                echo ($rs['zipcode']);
            } else {
                echo "-";
            } "</li>";
            ?>

        </ul>
        &nbsp;&nbsp;Tel : <?php echo $rs['tel'] ?>
        &nbsp;&nbsp;Email : <?php echo $rs['email'] ?><br/>

        &nbsp;&nbsp;รหัสสั่งซื้อ : <?php echo $rs['order_id']; ?><br/>
        &nbsp;&nbsp;ข้อความ <?php echo $rs['msg'] ?>
    </div>        
<?php endforeach; ?>




