<!DOCTYPE html>
<html>
<head>
  <title>Chat App</title>

  <!-- Ajax -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

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

  <!-- Camera JS -->
  <script src="<?php echo base_url() ?>assets/js/camera.js" type="text/javascript" charset="utf-8" async defer></script>

</head>
<body>
  <?php
      echo $contents;
  ?>
</body>
</html>