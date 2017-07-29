<!DOCTYPE html>
<html>
  <head>
    <title>EasyRTC Demo: Simple Video+Audio</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/easyrtc.css" />
 
    <!-- Assumes global locations for socket.io.js and easyrtc.js -->
    <script src="<?php echo base_url(); ?>assets/js/socket.io.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/easyrtc.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/demo_audio_video_simple.js"></script>
 
  </head>
  <body onLoad="connect();">
        <div id="demoContainer">
          <div id="connectControls">
            <div id="iam">Not yet connected...</div>
            <br />
            <strong>Connected users:</strong>
            <div id="otherClients"></div>
          </div>
          <div id="videos">
            <video autoplay="autoplay" class="easyrtcMirror" id="selfVideo" muted="muted" volume="0" ></video>
            <div style="position:relative;float:left;">
            <video autoplay="autoplay" id="callerVideo"></video>
            </div>
            <!-- each caller video needs to be in it"s own div so it"s close button can be positioned correctly -->
          </div>
        </div>
  </body>
</html>