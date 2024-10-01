<?php
  require_once 'config/require_login.php'; 
  require_once 'config/db_conn.php';
  $page_title = 'Edit Blog';
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
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      require_once 'config/update_blog.php';
    }else if($_SERVER['REQUEST_METHOD'] == 'GET'){
      $blog_id = $mysqli->real_escape_string($_GET["id"]);
      $result = $mysqli->query("SELECT * FROM blogs WHERE id = $blog_id ");
      if($result->num_rows > 0){
        ['id'=>$id, 'title'=>$title, 'content'=>$content, 'tags'=>$tags, ] = $result->fetch_assoc();
      }else{
        echo "Blog doesn't exist";
        exit;
      }
    }
  ?>
  <div class="flex justify-center px-4 py-8" >
    <?php include 'components/blog_form.php';?>
  </div>
</body>
</html>