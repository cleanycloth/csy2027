<form id="edit-slide-form" action="" method="post" enctype="multipart/form-data">
    <h2><?=$pageName;?></h2>
    <output><?=(isset($error)) ? $error : '';?></output>
    <p class="required">Required:</p>
    <div class="fields">    
        <?php if (isset($_GET['id'])): ?>
            <input type="hidden" name="slide[slide_id]" value="<?=$slide->slide_id;?>">
            <label for="image-preview"></label>
            <a target="__blank" href="<?=$slide->image;?>"><img style="height: 75; width: 288px; background-color: white;" src="<?=$slide->image;?>" alt="<?=($slide->image != '/images/image-slide-placeholder.jpg') ? htmlspecialchars(strip_tags($slide->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>"></a>
        <?php endif; ?>
        
        <label for="image">Image</label>
        <input type="file" accept="image/jpeg" name="image" id="image">

        <label for="name" class="required">Slide Name</label>
        <input type="text" name="slide[name]" id="name" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($slide->name), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['slide'])) { echo $_POST['slide']['name']; } ?>">

        <label for="message" class="required">Message</label>
        <input type="text" name="slide[message]" id="message" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($slide->message), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['slide'])) { echo $_POST['slide']['message']; } ?>">

        <label for="url" class="required">URL</label> 
        <input type="url" name="slide[url]" id="url" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($slide->url), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['slide'])) { echo $_POST['slide']['url']; } ?>">
    </div>

    <div class="buttons">
        <input type="submit" name="submit" value="Submit">
    </div>
</form>