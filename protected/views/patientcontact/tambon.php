<?php
$tambons = Tambon::model()->findAll("ampur_id = '$ampur' ");
?>

<select id="tambon" name="PatientContact[tambon]" class="form-control" required="required">
    <?php foreach ($tambons as $rs): ?>
        <option value="<?php echo $rs['tambon_id'] ?>" <?php if($rs['tambon_id'] == $tambon){ echo "selected";}?>><?php echo $rs['tambon_name'] ?></option>
    <?php endforeach; ?>
</select>

