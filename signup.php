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
  $title = 'Signup';
  include 'components/head.php';
?>
<body class="bg-gray-50 text-gray-800 min-h-screen">
  <?php
  require_once 'config/db_conn.php';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = '';
    $form_errors = ['name'=>'', 'email'=>'', 'pass'=>''];

    $user_name = $mysqli->real_escape_string($_POST["name"]);
    if(!preg_match("/^[a-zA-Z][\w ]*$/", $user_name)){
      $form_errors['name'] = 'Username should start with a letter and only include letters, numbers, underscores, and spaces';
    }
    $user_email = $mysqli->real_escape_string($_POST["email"]);
    if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
      $form_errors['email'] = 'Invalid email';
    }
    $user_pass = $mysqli->real_escape_string($_POST["password"]);
    if(empty($user_pass)){
      $form_errors['pass'] = 'Password should not be empty';
    }


    if(empty($error) && empty($form_errors['name']) && empty($form_errors['email']) && empty($form_errors['pass'])){
      if($mysqli->query("SELECT email FROM users WHERE email = '$user_email'")->num_rows>0){
        $error = 'User with this email already exists';
      }else{
        $user_pass = password_hash($user_pass, PASSWORD_BCRYPT);
        if($mysqli->query("INSERT INTO users (`name`,`email`,`password`) VALUES('$user_name','$user_email','$user_pass')")){
          $_SESSION['email'] = $user_email;
          $_SESSION['user_id'] = $mysqli->insert_id;
          header('location:dashboard.php');
          exit();
        }else{
          $error = "MySQL error: $mysqli->error";
        }
      }
    }
  }
  include 'components/login_form.php';
  ?>
</body>
</html>