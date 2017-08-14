<!DOCTYPE html>
<html>
<head>
  <title>Chat App</title>

  <!-- Ajax -->
  <script type="text/javascript" src="<?php echo base_url() . 'assets/js/'; ?>jquery.min.js"></script>

  <!-- Chat js -->
  <script type="text/javascript" src="<?php echo base_url() . 'assets/js/'; ?>chat.js"></script>

  <!-- Chat ID and User ID declaration for Ajax  -->
  <script type="text/javascript">
    var chat_id = "<?php echo $chat_id; ?>";
    var user_id = "<?php echo $user_id; ?>";
  </script>

  <!-- Base URL declaration -->
  <script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
  </script>

  <!-- Template/CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/chat.css">
  
  <!-- Camera CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/camera.css">

  <!-- Simple WebRTC JS -->
  <script src="<?php echo base_url() ?>assets/js/latest-v2.js"></script> 
  
  <!-- Bootstrap -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css">

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        echo $contents;
    ?>
</body>
</html>