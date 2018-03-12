<style type="text/css">
    #mix thead tr th{
        white-space: nowrap;
    }
    #mix tbody tr td{
        white-space: nowrap;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-bordered table-hover" id="mix">
            <thead>
                <tr>
                    <th>รหัส</th>
                    <th>วัตถุดิบ</th>
                    <th style=" text-align: right;">จำนวน</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($mixer as $rs): $i++;
                    ?>
                    <tr onclick="action('<?php echo $rs['id'] ?>')" style=" cursor: pointer;">
                        <td><?php echo $rs['itemscode'] ?></td>
                        <td><?php echo $rs['itemname'] ?></td>
                        <td style=" text-align: right; color: #ff0000;"><?php echo $rs['number'] . ' ' . $rs['unit'] ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<script type="text/javascript">
    function action(id) {
        $("#_id").val(id);
        $("#action").modal();
    }

</script>

