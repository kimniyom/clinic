<hr/>

<?php 
    $config = new Configweb_model();
?>
<table class="table table-bordered" id="sell">
    <thead>
        <tr>
            <th style=" width: 5%;">#</th>
            <th>รหัสการขาย</th>
            <th style=" text-align: right;">ราคา</th>
            <th>พนักงาน</th>
            <th>วันที่</th>
            <th>สาขา</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0;foreach($sell as $rs): $i++;
        $branch = $rs['branch'];
        ?>
        <tr>
            <td style=" text-align: center;"><?php echo $i ?></td>
            <td><?php echo $rs['sell_id'] ?></td>
            <td style=" text-align: right;"><?php echo number_format($rs['totalfinal']) ?></td>
            <td><?php echo $rs['name']." ".$rs['lname'] ?></td>
            <td><?php echo $config->thaidate($rs['date_sell']) ?></td>
            <td><?php echo Branch::model()->find("id = '$branch' ")['branchname']?></td>
            <td style="text-align: center;">
                <a href="Javascript:PrintBill('<?php echo $rs['sell_id']?>')"><i class="fa fa-print">พิมพ์ใบเสร็จ</i></a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>

<script type="text/javascript">
    function PrintBill(sellcode) {
        var url = "<?php echo Yii::app()->createUrl('sell/bill') ?>" + "&sell_id=" + sellcode;
        PopupBill(url, sellcode);
    }
    
    function PopupBill(url, title) {
        // Fixes dual-screen position  
        //                        Most browsers      Firefox
        var w = 800;
        var h = 600;
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    }
</script>

<script type="text/javascript">

    Setscreen();
    function Setscreen() {
        var boxsell = $(window).height();
        //var contentboxsell = $("#content-boxsell").height();
        var screenfull = (boxsell - 315);
        $("#sell").dataTable({
            //"sPaginationType": "full_numbers", // แสดงตัวแบ่งหน้า
            "bLengthChange": false, // แสดงจำนวน record ที่จะแสดงในตาราง
            //"iDisplayLength": 50, // กำหนดค่า default ของจำนวน record
            //"scrollCollapse": true,
            "paging": false,
            "bFilter": true, // แสดง search box
            "sScrollY": screenfull, // กำหนดความสูงของ ตาราง
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'print'
            ]
        });
    }

</script>

