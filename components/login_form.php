<div class="flex w-dvw h-dvh justify-center items-center">
  <form method="POST" class="flex flex-col items-stretch gap-4 p-4 bg-white border rounded-lg w-72 shadow-sm">
    <h1 class="text-center text-2xl font-bold" ><?= $title ?></h1>

    <?php if($title == 'Signup'):?>
      <input type="text" name="name" class="rounded-lg border px-2 py-1" placeholder="Username" required>
      <?php if(!empty($form_errors['name'])):?>
        <div class="text-red-500 text-center"><?= $form_errors['name'] ?></div>
      <?php endif?>
    <?php endif?>

    <input type="text" name="email" class="border rounded-lg px-2 py-1" placeholder="Email" required autofocus >
    <?php if(!empty($form_errors['email'])):?>
      <div class="text-red-500 text-center"><?= $form_errors['email'] ?></div>
    <?php endif?>
    
    <div class="flex w-full items-center">
      <input type="password" id="password" name="password" class="border rounded-lg px-2 py-1 w-full" placeholder="Password" required>
      <button type="button" class="-ml-10 transition text-slate-600 hover:text-blue-600 flex justify-center items-center text-sm" id="show">
        Show
      </button>
    </div>
    <?php if(!empty($form_errors['pass'])):?>
      <div class="text-red-500 text-center"><?= $form_errors['pass'] ?></div>
    <?php endif?>

    <input type="submit" value="Submit" class="cursor-pointer transition bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2" >
    <?php if(!empty($error)):?>
      <div class="text-red-500 text-center"><?= $error ?></div>
    <?php endif?>
    
    <div class="text-center" >
      <?php if($title == 'Login'):?>
        Don't have an account? <a href="signup.php" class="text-blue-500" >Signup</a>
      <?php else:?>
        Already have an account? <a href="login.php" class="text-blue-500" >Login</a>
      <?php endif?>
    </div>
  </form>
</div>
<script>
  const show = document.getElementById('show')
  const password =document.getElementById('password')
  show.addEventListener('click',(e)=>{
    e.preventDefault();
    if(password.type == 'password'){
      password.type = 'text'
      show.innerText = 'Hide'
    }else{
      password.type = 'password'
      show.innerText = 'Show'
    }
  })
</script>