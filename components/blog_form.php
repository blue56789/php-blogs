<form method="POST" id="form" class="w-dvw h-dvh flex flex-col p-4 gap-4 max-w-xl bg-white border rounded-lg shadow-sm" >
  <h1 class="text-center text-2xl font-bold" ><?= $page_title ?></h1>

  <input type="hidden" name="id" value="<?= $id ?>">
  <?php if(!empty($errors['id'])){?>
    <div class="text-red-500"><?= $errors['id'] ?></div>
  <?php }?>

  <input type="text" name="title" value="<?= $title ?>" class="rounded-lg border px-2 py-1" placeholder="Title" required>
  <?php if(!empty($errors['title'])){?>
    <div class="text-red-500"><?= $errors['title'] ?></div>
  <?php }?>

  <div id="editor" class="h-full overflow-y-scroll" required></div>
  <textarea id="content" name="content" value="<?= htmlspecialchars($content) ?>" hidden required></textarea>
  <?php if(!empty($errors['content'])){?>
    <div class="text-red-500"><?= $errors['content'] ?></div>
  <?php }?>

  <input type="text" name="tags" value="<?= $tags ?>" class="rounded-lg border px-2 py-1" placeholder="Tags (comma separated)">
  <?php if(!empty($errors['tags'])){?>
    <div class="text-red-500"><?= $errors['tags'] ?></div>
  <?php }?>

  <div class="flex gap-4 items-center">
    <button class="cursor-pointer transition bg-green-600 hover:bg-green-700 text-white flex-1 rounded-lg py-2" id="saveDraft">Save Draft</button>

    <input type="submit" value="Publish" class="cursor-pointer transition bg-blue-600 hover:bg-blue-700 text-white flex-1 rounded-lg py-2" >
    <?php if(!empty($error)){?>
      <div class="text-red-500"><?= $error ?></div>
    <?php }?>
  </div>

</form>
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
  const quill = new Quill('#editor', {
    theme: 'snow',
    placeholder: 'Content',
    bounds: '#editor'
  });

  quill.clipboard.dangerouslyPasteHTML('<?= $content ?>');

  const content = document.getElementById('content');
  content.value = '<?= $content ?>'

  quill.on('editor-change', (delta, oldDelta, source)=>{
    content.value = quill.getSemanticHTML();
  })
  
  const form = document.getElementById('form');

  const saveDraft = async()=>{
    const formData = new FormData(form);
    const data = {};
    for(const [key, value] of formData.entries()){
      data[key] = value;
    }
    // console.log(data);
    
    const response = await fetch('/api/save_draft.php', {
      method: "POST",
      headers:{
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })

  }

  let timeout = null;
  form.addEventListener('keyup',(e)=>{
    clearTimeout(timeout);
    timeout = setTimeout(saveDraft, 1000);
  })

  const saveDraftButton = document.getElementById('saveDraft')
  saveDraftButton.addEventListener('click', async(e)=>{
    e.preventDefault();
    saveDraftButton.innerHTML = "Saving"
    await saveDraft();
    window.location = '/dashboard.php'
  });
</script>