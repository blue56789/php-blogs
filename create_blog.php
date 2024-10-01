<?php
  require_once 'config/require_login.php'; 
  require_once 'config/db_conn.php';
  $page_title = 'New Blog';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page_title ?></title>
  <link rel="stylesheet" href="output.css">
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">
  <?php
    $id = $title = $content = $tags = '';
    $errors = ['id'=>'','title'=>'','content'=>'','tags'=>''];

    $user_id = $mysqli->real_escape_string($_SESSION['user_id']);
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      require_once 'config/update_blog.php';
    }else{
      $result = $mysqli->query("INSERT INTO blogs(author,title) VALUES($user_id,'New Blog')");
      if($result){
        $id = $mysqli->insert_id;
        $title = 'New Blog';
      }
    }
  ?>
  <div class="flex justify-center px-4 py-8" >
  <?php include 'components/blog_form.php';?>
  </div>
</body>
</html>