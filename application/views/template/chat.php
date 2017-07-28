<!DOCTYPE html>
<html>
<head>
  <title>Chat App</title>
  <!-- Ajax -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <!-- Chat js -->
  <script type="text/javascript" src="<?php echo base_url() . 'assets/js/'; ?>chat.js"></script>
  <!--  -->
  <script type="text/javascript">
    var chat_id = "<?php echo $chat_id; ?>";
    var user_id = "<?php echo $user_id; ?>";
  </script>
  <!-- Base URL -->
  <script type="text/javascript">
    var base_url = "<?php echo base_url(); ?>";
  </script>
  <!-- Template/CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/chat.css">
</head>
<body>
  <?php
      echo $contents;
  ?>
</body>
</html>