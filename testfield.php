<?php
$server_path = $_SERVER["HTTP_HOST"];
$userlogin = "https://www.$server_path/login";
header('Location: '.$userlogin);
?>
