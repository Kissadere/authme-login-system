<?php
$server_path = $_SERVER["HTTP_HOST"];
$userlogin = "https://$server_path/login";


if(empty(session_id())) {
   session_start();
}

if (!isset($_SESSION['username']) && !isset($_SESSION['uri'])) {
   $_SESSION['referrer'] = $_SERVER['REQUEST_URI'];
      header('Location: '.$userlogin);
   exit;
}
?>
