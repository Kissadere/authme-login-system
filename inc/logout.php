<?php
$server_path = $_SERVER["HTTP_HOST"];
$destination = "https://$server_path/login";


if (isset($_POST['form_name']) && $_POST['form_name'] == 'logoutform') {

   if(empty(session_id())) {
      session_start();
   }

   unset($_SESSION['username']);
   unset($_SESSION['uuid']);
}
header('Location: '.$destination);
?>
