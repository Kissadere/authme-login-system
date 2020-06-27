<?php
/* ZIBUU ENTERTAINMENT, (C) 2015 - 2020.
 ________   ______   ____     __  __  __  __
/\_____  \ /\__  _\ /\  _`\  /\ \/\ \/\ \/\ \
\/____//'/'\/_/\ \/ \ \ \L\ \\ \ \ \ \ \ \ \ \
     //'/'    \ \ \  \ \  _ <'\ \ \ \ \ \ \ \ \
    //'/'___   \_\ \__\ \ \L\ \\ \ \_\ \ \ \_\ \
    /\_______\ /\_____\\ \____/ \ \_____\ \_____\
    \/_______/ \/_____/ \/___/   \/_____/\/_____/

*/
include './inc/database.php';


  // Variables
  $mysql_table = 'core_mcusers';
  $found = false;
  // Message should be blank
  $message = '';
  // We can freely edit these stuffs if needed
  $success_page = 'dashboard.php';
  $page_title = 'Zibuu – Login to your account';
  // Required user data
  $username = $_POST['username'];
  $plain_pass = $_POST['password'];
  $nickname = '';
  $uuid = '';

// Making sure our form has been submitted
if(isset($_POST['form_status']) && isset($_POST['username']) && isset($_POST['password'])) {

  // Securing our input data to prevent malicious code insertions
  $username = mysqli_real_escape_string($db, $username);
  $plain_pass = mysqli_real_escape_string($db, $plain_pass);
  $uuid = mysqli_real_escape_string($db, $uuid);

  // Connecting to our database and querying the needed data
  $sql = "SELECT password, uuid FROM $mysql_table WHERE username = \"$username\"";
  $result = mysqli_query($db, $sql);
  // If the username matchs our database records, then we will verify its password
  if ($data = mysqli_fetch_array($result)) {
      $storedpassword = $data['password'];
      // Verifying the entered password and our records password
      if (password_verify($plain_pass, $storedpassword)) {
         // Changing our found status to true if the passwords match
         $found = true;
         $username = $data['username'];
         $nickname = $data['nickname'];
         $uuid = $data['uuid'];
      }
   }

   mysqli_close($db);
   // If no username or password matchs, we will print this error
   if($found == false) {
      $message = 'Username or password are incorrect, try again';
      header("Location: ".$error);
   }

   // Otherwise, proceed to the dashboard and starting our session
    else {
      if (session_id() == "") {
         session_start();
      }
      // Setting up our session variables
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['uuid'] = $uuid;
      // Setting up our cookie variables
      $username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
      $uuid = isset($_COOKIE['uuid']) ? $_COOKIE['uuid'] : '';
      $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';

      // Redirecting to our dashboard
      header('Location: '.$success_page);
   }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo $page_title ?></title>
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
    <div class="login-clean">
        <form method="post" id="login" name="login" autocomplete="off" action="" accept-charset="utf-8">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <input type="hidden" name="form_status" id="form_status" value="1">
            <div class="form-group"><input class="form-control" type="text" name="username" placeholder="Minecraft username" id="username" autocomplete="false" maxlength="30" required="true"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" id="password" required="true" maxlength="30"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit" id="submit">Login</button></div>
            <div class="form-group"><p style="color: red"><?php echo $message ?></p></div>
        </form>
    </div>
    <!-- End: Login Form Clean -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
