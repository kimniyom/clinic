<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>สาขา</th>
            <th style=" text-align: center;">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0;foreach($branch as $rs): $i++;?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $rs['branchname'] ?></td>
            <td style="text-align: center;">
                <a href="javascript:Deletebranch('<?php echo $rs['id']?>')"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
