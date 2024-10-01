<?php 
  session_start();
  if(isset($_SESSION['email'])){
    header('location:dashboard.php');
    exit();
  } 
?>
<!DOCTYPE html>
<html lang="en">
<?php 
  $title = 'Login';
  include 'components/head.php';
?>
<body class="bg-gray-50 text-gray-800 min-h-screen">
  <?php
  require_once 'config/db_conn.php';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $mysqli->real_escape_string($_POST["email"]);
    $user_pass = $mysqli->real_escape_string($_POST["password"]);
    $result = $mysqli->query("SELECT `password`, id FROM users WHERE email = '$user_email' ");
    $row = $result->fetch_row();
    if($result->num_rows > 0 && password_verify($user_pass, $row[0])){
      $_SESSION['email'] = $user_email;
      $_SESSION['user_id'] = $row[1];
      header('location:dashboard.php');
      exit();
    }else{
      $error = 'Invalid credentials';
    }
  }
  include 'components/login_form.php';
  ?>
  
</body>
</html>