<?php
/* session_start();
  $exit = "false";
  if (!isset($_SESSION[$uid . 'FreiChatX_init'])){
  //$exit = "true";
  }
 */

require_once '../../../arg.php';

$cvs = new FreiChat();
$cvs->init_vars();

$frei_trans = $cvs->frei_trans;
$smileys = str_replace("'", "\'", json_encode($cvs->get_smileys()));

$exit = "false";

if (isset($_GET['rid'])) {

    $rid = (int) $_GET['rid'];
} else {
    $exit = "true";
}

$no_get = !isset($_GET['id']) || !isset($_GET['xhash']);

if ($no_get) {
    $exit = "true";
}

$url = str_replace('client/plugins/videochat/voicechat.php', '', $cvs->url);


if (isset($_SERVER['HTTP_REFERER'])) {
    $referer_url = $_SERVER['HTTP_REFERER'];
} else {
    $referer_url = $url;
}


if (strpos($referer_url, 'www.') == TRUE) {
    $url = str_replace('http://', 'http://www.', $url);
    $url = str_replace('https://', 'https://www.', $url);
} else {

    $url = str_replace('http://www.', 'http://', $url);
    $url = str_replace('https://www.', 'https://', $url);
}

if (strpos($url, 'www.www.') == TRUE) {
    $url = str_replace('http://www.www.', 'http://www.', $url);
    $url = str_replace('https://www.www.', 'https://www.', $url);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="chrome=1" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

        <link rel="stylesheet" href="voicechat.css" type="text/css"  />
        <link rel="stylesheet" href="../../../administrator/css/bootstrap-classic.css" type="text/css"  />
        <link href="../../../administrator/css/bootstrap-responsive.css" rel="stylesheet" />
        <script type='text/javascript' src='https://cdn.firebase.com/v0/firebase.js'></script>

        <script type="text/javascript" src="../../jquery/js/jquery.1.8.3.js"></script>
        <script src="../../jquery/js/bootstrap.min.js"></script>


        <script>

            var rid = <?php echo $rid; ?>;
            var exit = '<?php echo $exit; ?>';

            var id = "<?php echo $_GET['id']; ?>";
            var xhash = "<?php echo $_GET['xhash']; ?>";

            var chat_message_me = '<?php echo $frei_trans["chat_message_me"]; ?>';
            var smileys = '<?php echo $smileys; ?>';

            $jn = jQuery;

            var freidefines = {
                GEN: {
                    getid: id,
                    url: '<?php echo $url; ?>'
                },
            }
        </script>
    </head>
    <body>

        <audio src="" />
    </body>
</html>