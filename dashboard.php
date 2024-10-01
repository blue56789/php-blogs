<?php
  require_once 'config/require_login.php';
  require_once 'config/db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php 
  $title = 'Dashboard';
  include 'components/head.php';
?>
<body class="bg-gray-50 text-gray-800 min-h-screen">
  <?php include 'components/navbar.php';?>
  <?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit'] == 'Delete'){
      $blog_id = $mysqli->real_escape_string($_POST['id']);
      $mysqli->query("DELETE FROM blogs WHERE id = $blog_id");
    }
  ?>
  <div class="flex justify-center" >
    <div class="flex flex-col container px-4 py-8 gap-4 justify-center items-stretch">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Your Dashboard</h1>
        <a href="create_blog.php" class="flex items-center gap-2 transition text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg" ><div>New Blog</div> </a>
      </div>
      <?php
        $user_id = $_SESSION['user_id'];
        $result = $mysqli->query("SELECT * FROM blogs WHERE author = $user_id");
        if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
      ?> 
        <div class="bg-white border shadow-sm rounded-lg flex flex-col sm:flex-row p-4 gap-4 justify-between items-start sm:items-center group">
          <div class="w-full flex flex-col gap-2">
            <a class="block font-semibold text-lg text-blue-600 hover:text-blue-800 transition" href="blog.php?id=<?= $row['id'] ?>" ><?= $row['title'] ?></a>
            <div class="text-sm text-gray-500"><?= $row['final'] ? 'Published' : 'Draft saved' ?> on <?= (new DateTime($row['publishedAt']))->format("d M, Y H:i") ?></div>
          </div>
          <form method="post">
            <input type="text" name="id" value="<?= $row['id'] ?>" hidden >
            <div class="flex gap-4 items-center">
              <?php if($row['final']):?>
                <div class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Published</div>
              <?php else: ?>
                <div class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Draft</div>
              <?php endif ?>
              <a class="text-blue-600 hover:text-blue-800 transition" href="edit_blog.php?id=<?= $row['id'] ?>" >Edit</a>
              <input type="submit" name="submit" value="Delete" class="cursor-pointer text-red-600 hover:text-red-800 transition" >
            </div>
          </form>
        </div>
      <?php } 
        }else{ ?>
          <div class="text-center" >You haven't posted any blogs</div>
      <?php }?>
    
    </div>
  </div>
</body>
</html>