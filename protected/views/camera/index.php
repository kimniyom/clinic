<?php
/*
  $onBeforeSnap = "document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';";
  $completionHandler = <<<BLOCK
  if (msg == 'OK') {
  document.getElementById('upload_results').innerHTML = '<h1>OK! ...redirecting in 3 seconds</h1>';

  // reset camera for another shot
  webcam.reset();
  setTimeout(function(){window.location = "index.php?r=camera/index";},3000);
  }
  else alert("PHP Error: " + msg);
  BLOCK;
  $this->widget('application.extensions.jpegcam.EJpegcam', array(
  'apiUrl' => 'index.php?r=camera/jpegcam.saveJpg',
  'shutterSound' => false,
  'stealth' => true,
  'camWidth' => 800,
  'camHeight' => 600,
  'buttons' => array(
  'configure' => 'Configure',
  'takesnapshot' => 'Take Snapshot!'
  ),
  'onBeforeSnap' => $onBeforeSnap,
  'completionHandler' => $completionHandler
  ));
 * 
 */
?>
<!--<div id="upload_results"></div>-->
<script>
    $(function () {
        //give the php file path
        webcam.set_api_url('<?php echo Yii::app()->createUrl('camera/saveimage') ?>');
        webcam.set_swf_url('<?php echo Yii::app()->baseUrl; ?>/lib/php-webcamera/scripts/webcam.swf');//flash file (SWF) file path
        webcam.set_quality(100); // Image quality (1 - 100)
        webcam.set_shutter_sound(true, '<?php echo Yii::app()->baseUrl; ?>/sound/shutter.mp3'); // play shutter click sound
        var camera = $('#camera');
        camera.html(webcam.get_html(898, 600)); //generate and put the flash embed code on page

        $('#capture_btn').click(function () {
            //take snap
            webcam.snap();
            $('#show_saved_img').html('<h3>Please Wait...</h3>');
        });


        //after taking snap call show image
        webcam.set_hook('onComplete', function (img) {
            //alert(img);
            $('#show_saved_img').html('<img src="' + img + '" class="img-responsive">');
            //reset camera for the next shot
            webcam.reset();
        });

    });
</script>

<button type="button" class="btn btn-primary" onclick="camera()"><i class="fa fa-camera-retro"></i> ถ่ายภาพ</button>

<div class="row">
    <!-- show captured image -->
    <div id="show_saved_img" ></div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="popupcamera">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <center>
                    <button class="btn btn-warning" id="capture_btn"><i class="fa fa-camera"></i> Capture</button>
                </center>
            </div>
            <div class="modal-body" style="padding: 0px;">
                <div id="camera"></div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<script type="text/javascript">
    function camera() {
        $("#popupcamera").modal();
    }
</script>