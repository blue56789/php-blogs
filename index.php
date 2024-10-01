<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php';?>
<body class="bg-gray-50 text-gray-800 min-h-screen">
  <?php 
    include 'components/navbar.php';
    require_once 'config/db_conn.php';
    
    $filters = ['title','content','tags'];
    $filter = $_GET['filter'] ?? '';
    $filter = in_array($filter,$filters,true) ? $filter : 'title';
    $search_query = $mysqli->real_escape_string($_GET["query"] ?? '');
  ?>
  <div class="flex justify-center" >
    <div class="flex flex-col p-4 gap-4 justify-center items-stretch container">

      <form method="GET" class="self-end flex gap-2 sm:gap-4" >
        <select name="filter" class="bg-white px-4 py-2 rounded-lg border shadow-sm">
          <option <?= $filter == $filters[0] ? 'selected': '' ?> value="<?= $filters[0] ?>">Title</option>
          <option <?= $filter == $filters[1] ? 'selected': '' ?> value="<?= $filters[1] ?>">Content</option>
          <option <?= $filter == $filters[2] ? 'selected': '' ?> value="<?= $filters[2] ?>">Tags</option>
        </select>
        <input type="text" class="bg-white border rounded-lg px-4 py-2" name="query" value="<?= $search_query ?? '' ?>" placeholder="Search">
      </form>

      <?php
      $result = $mysqli->query("SELECT blogs.id AS id, title, `name` AS author, content, publishedAt
        FROM blogs JOIN users 
        ON blogs.author = users.id
        WHERE final <> 0 AND $filter LIKE '%$search_query%' ORDER BY publishedAt DESC ");
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
      ?>
      <div class="flex flex-col bg-white border shadow-sm rounded-lg p-6 gap-2">
        <a href="blog.php?id=<?= $row['id'] ?>" class="font-semibold text-xl text-blue-600 hover:text-blue-800 transition"><?= $row['title'] ?></a>
        <div class="line-clamp-2 truncate text-slate-700 mb-2"><?= $row['content'] ?></div>
        <div class="flex justify-between items-center text-sm text-gray-500">
          <div><?= $row['author'] ?></div>
          <div><?= (new DateTime($row['publishedAt']))->format("d M, Y") ?></div>
        </div>
      </div>
      <?php }
      }else{
      ?>
        <div>No blogs</div>
      <?php }?>
    </div>
  </div>
</body>
</html>