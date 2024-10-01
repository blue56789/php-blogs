<?php
  require_once '../config/db_conn.php';
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    header('Content-Type: application/json');

    $blog=json_decode(file_get_contents("php://input"), true);
    //some code
    // print_r($test);

    $id = $mysqli->real_escape_string($blog['id']);
    $title = $mysqli->real_escape_string($blog['title']);
    $content = $mysqli->real_escape_string($blog['content']);
    $tags = $mysqli->real_escape_string($blog['tags']);

    $result = $mysqli->query("UPDATE blogs SET title = '$title', content = '$content', tags = '$tags', final = false WHERE id = $id");
    if($result){
      echo "draft saved";
    }else{
      echo "MySQL error $mysqli->error";
    }
  }