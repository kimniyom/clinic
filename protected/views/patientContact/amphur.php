<?php
$amphurs = Ampur::model()->findAll("changwat_id = '$changwat' ");
?>

<select id="amphur" name="PatientContact[amphur]" class="form-control" required="required">
    <?php foreach ($amphurs as $rs): ?>
        <option value="<?php echo $rs['ampur_id'] ?>" <?php if($rs['ampur_id'] == $amphur){ echo "selected";}?>><?php echo $rs['ampur_name'] ?></option>
    <?php endforeach; ?>
</select>
<script type="text/javascript">
        tambon();
       $("#amphur").change(function(){
           $("#tambon option:selected").val(<?php echo $tambon ?>);
           var url = "<?php echo Yii::app()->createUrl('patientcontact/tambon')?>";
           var ampur = $("#amphur").val();
           var data = {ampur: ampur};
           $.post(url,data,function(result){
               $("#_tambon").html(result);
           });
       }) ;

    function tambon(){
        var url = "<?php echo Yii::app()->createUrl('patientcontact/tambon')?>";
           var ampur = $("#amphur").val();
           var tambon = "<?php echo $tambon ?>";
           var data = {
               ampur: ampur,
               tambon: tambon
           };
           $.post(url,data,function(result){
               $("#_tambon").html(result);
           }); 
    }
</script>