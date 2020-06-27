<?php
session_start();
include '../register/includes/database.php';
include "inc/loginsecurity.php";


// Variables
$mysql_table = 'perms_players';
$username = $_SESSION['username'];
$uuid = $_SESSION['uuid'];
$lowusername = mb_strtolower($username);
$avatar = "https://minotar.net/avatar/$username/100";

// Connecting to our database and querying the needed data
$sql = "SELECT * FROM $mysql_table WHERE username = \"$lowusername\"";
$result = mysqli_query($db, $sql);
// If the username matchs our database records, then we will verify its password
if ($data = mysqli_fetch_array($result)) {
  $group = $data['primary_group'];
}


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Zibuu – Welcome</title>
    <meta name="twitter:description" content="A single username and password gets you into everything. Set up your profile and review your character stats on the go">
    <meta name="twitter:image" content="assets/img/webtitle.png?h=7833c8dcc3e6c3c3dc4fea2631b037c6">
    <meta name="author" content="Zibuu Entertainment">
    <meta name="description" content="A single username and password gets you into everything. Set up your profile and review your character stats on the go">
    <meta property="og:image" content="assets/img/webtitle.png?h=7833c8dcc3e6c3c3dc4fea2631b037c6">
    <meta name="twitter:title" content="Zibuu – Register your account">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css?h=587ac2057624923cd5be3eaf8b1158cd">
    <link rel="stylesheet" href="assets/css/styles.css?h=d41d8cd98f00b204e9800998ecf8427e">
</head>

<body>
    <!-- Start: Login Form Clean -->
<img src="<?php echo $avatar ?>"/>
    <!-- End: Login Form Clean -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
