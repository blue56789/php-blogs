<?php 
  $id = $mysqli->real_escape_string($_POST["id"]);
  if(!is_numeric($id)){
    $errors['id'] = 'Id should be a number';
  }
  $title = $mysqli->real_escape_string($_POST['title']);
  if(empty($title)){
    $errors['title'] = 'Title should not be empty';
  }
  $content = $mysqli->real_escape_string($_POST['content']);
  if(empty($content) || $content == '<p></p>'){
    $errors['content'] = 'Content should not be empty';
  }
  $tags = $mysqli->real_escape_string($_POST['tags']);
  if(!preg_match("/^([\w ])*(,[\w ]+)*$/", $tags)){
    $errors['tags'] = 'Tags should be a comma separated list of words containing alphanumeric characters';
  }
  if(!$errors['id'] && !$errors['title'] && !$errors['content'] && !$errors['tags'] ){
    $result = $mysqli->query("UPDATE blogs SET title = '$title', content = '$content', tags = '$tags', final = true WHERE id = $id");
    if($result){
      header("location:dashboard.php");
    }else{
      $error = "MySQL error: $mysqli->error";
    }
  }