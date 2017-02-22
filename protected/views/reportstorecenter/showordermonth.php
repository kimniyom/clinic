<table style=" width: 100%;" class="table"> 
    <thead>
        <tr>
            <th>เดือน</th>
            <th style=" text-align: right;">จำนวน</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($datas as $rss): ?>
            <tr>
                <td><?php echo $rss['month_th'] ?></td>
                <td style=" text-align: right;"><?php echo number_format($rss['total']) ?></td>  
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

