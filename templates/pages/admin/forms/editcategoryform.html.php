<form id="edit-category-form" action="" method="post">
    <h2><?=$pageName;?></h2>
    <output><?=(isset($error)) ? $error : '';?></output>
    <?php if (!isset($_GET['id'])): ?>
        <p class="required">Required:</p>
    <?php endif; ?>
    <div class="fields">    
        <?php if (isset($_GET['id'])): ?>
            <input type="hidden" name="category[category_id]" value="<?=$category->category_id;?>">
        <?php endif; ?>
        
        <label for="name" <?=(isset($_GET['id'])) ? '' : 'class="required"';?>>Category Name</label>
        <input type="text" name="category[name]" id="name" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($category->name), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['category'])) { echo $_POST['category']['name']; } ?>">
    
        <label for="parent-category">Parent Category</label>
        <select name="category[parent_id]" id="parent-category">
            <?php if (isset($parentCategory) && !(empty($parentCategory))): ?>
                <option selected="selected" value="<?=$parentCategory->category_id;?>"><?=htmlspecialchars(strip_tags($parentCategory->name), ENT_QUOTES, 'UTF-8');?></option>
            <?php endif; ?>

            <option <?=(!isset($parentCategory) || isset($parentCategory) && empty($parentCategory)) ? 'selected="selected"' : '';?> value="">None</option>

            <?php foreach ($categories as $categoryChoice): ?>
                <?php if ($categoryChoice->parent_id == null): ?>
                    <?php if ($categoryChoice->category_id != $parentCategory->category_id && $categoryChoice->category_id != $category->category_id): ?>
                        <option value="<?=$categoryChoice->category_id;?>"><?=htmlspecialchars(strip_tags($categoryChoice->name), ENT_QUOTES, 'UTF-8');?></option>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="buttons">
        <input type="submit" name="submit" value="Submit">
    </div>
</form>