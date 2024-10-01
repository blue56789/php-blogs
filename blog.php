<?php
  session_start();
  require_once 'config/db_conn.php';
  $blog_id = $mysqli->real_escape_string($_GET['id']);
  $result = $mysqli->query("SELECT blogs.*, users.`name` FROM blogs JOIN users ON blogs.author = users.id WHERE blogs.id = $blog_id");
  if($result->num_rows > 0){
    $blog = $result->fetch_assoc();
  }else{
    exit(); 
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $blog['title'] ?></title>
  <link rel="stylesheet" href="./output.css">
  <style>
    #content{
      & h1{ font-size: 2em; }
      & h2{ font-size: 1.5em; }
      & h3{ font-size: 1.17em; }
      & ul, ol{
        padding-left: 1em;
        margin-left: 1em;
      }
      & ul{
        list-style-type: disc;
      }
      & ol{
        list-style-type: decimal;
      }
      & a{
        color: blue;
        text-decoration: underline;
      }
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">
  <?php include 'components/navbar.php';?>
  <div class="flex justify-center px-4 py-8">
    <div class="flex flex-col gap-4 container bg-white border rounded-lg shadow-sm p-6">
      <h1 class="text-3xl font-bold text-blue-600" ><?= $blog['title'] ?></h1>
      <div class="flex justify-between items-center gap-4 mb-4 text-sm text-gray-500">
        <span>By <?= $blog['name'] ?></span>
        <span>Published on <?= (new DateTime($blog['publishedAt']))->format("d M, Y H:i") ?></span>
      </div>
      <div id="content" >
        <?= $blog['content'] ?>
      </div>
      <div class="flex gap-2 items-center mt-4" >
        <div class="font-semibold">Tags:</div>
        <?php foreach (explode(',',$blog['tags']??'') as $tag): ?>
          <?php if(!empty($tag)):?>
            <div><span class="text-blue-600">#</span><?= trim($tag) ?></div>
          <?php endif?>
        <?php endforeach?>
      </div>
    </div>
  </div>
</body>
</html>