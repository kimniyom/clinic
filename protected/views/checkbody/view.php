<div class="panel panel-warning">
    <div class="panel-heading"><i class="fa fa-child"></i> ตรวจร่างกาย</div>
    <div class="panel-body" id="font-th">
        <?php if (!empty($checkbody)) { ?>
            น้ำหนัก <p class="label" id="font-18"><?php echo $checkbody['weight'] ?></p><br/>
            ส่วนสูง <p class="label" id="font-18"><?php echo $checkbody['height'] ?></p><br/>
            อุณหภมูมิร่างกาย <p class="label" id="font-18"><?php echo $checkbody['btemp'] ?></p><br/>
            อัตราการเต้นชองชีพจร <p class="label" id="font-18"><?php echo $checkbody['pr'] ?></p><br/>
            อัตราการหายใจ <p class="label" id="font-18"><?php echo $checkbody['rr'] ?></p><br/>
            ความดันโลหิต <p class="label" id="font-18"><?php echo $checkbody['ht'] ?></p><br/>
            รอบเอว <p class="label" id="font-18"><?php echo $checkbody['waistline'] ?></p><br/>
            อาการสำคัญ <p class="label" id="font-18"><?php echo $checkbody['cc'] ?></p><br/>
        <?php } else { ?>
            <center>ยังไม่มีการตรวจร่างกาย</center>
        <?php } ?>
    </div>
</div>



