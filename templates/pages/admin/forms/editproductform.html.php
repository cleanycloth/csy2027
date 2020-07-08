<form id="edit-product-form" action="" method="post" enctype="multipart/form-data">
    <h2><?=$pageName;?></h2>
    <output><?=(isset($error)) ? $error : '';?></output>
    <p class="required">Required:</p>
    <div class="fields">
        <?php if (isset($_GET['id'])): ?>
            <input type="hidden" name="product[product_id]" value="<?=$product->product_id;?>">
            <label for="image-preview"></label>
            <a target="__blank" href="<?=$product->image;?>"><img style="height: 200px; width: 200px; background-color: white;" src="<?=$product->image;?>" alt="<?=($product->image != '/images/image-placeholder.jpg') ? htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>"></a>
        <?php endif; ?>
        
        <label for="image">Image</label>
        <input type="file" accept="image/jpeg" name="image" id="image">

        <label for="name" class="required">Product Name</label>
        <input type="text" name="product[name]" id="name" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['product'])) { echo $_POST['product']['name']; } ?>">

        <label for="price" class="required">Price</label> 
        <input type="text" name="product[price]" id="price" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($product->price), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['product'])) { echo $_POST['product']['price']; } ?>">

        <label for="description" class="required">Description</label>
        <textarea name="product[description]" id="description"><?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($product->description), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['product'])) { echo $_POST['product']['description']; } ?></textarea>

        <label for="category">Category</label>
        <select name="product[category_id]" id="category">
            <option <?=(isset($product) && !empty($product) && $product->category_id == 0) ? 'selected="selected"' : '';?> value="">None</option>
            <?php foreach ($categories as $categoryChoice): ?>
                <?php if ($categoryChoice->parent_id == null && count($categoryChoice->getChildCategories()) == 0 || $categoryChoice->parent_id != null): ?>
                    <option value="<?=$categoryChoice->category_id;?>"><?=htmlspecialchars(strip_tags($categoryChoice->name), ENT_QUOTES, 'UTF-8');?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>

        <label for="platform">Platform</label>
        <select name="product[platform_id]" id="platform">
            <option <?=(isset($product) && !empty($product) && $product->platform_id == 0) ? 'selected="selected"' : '';?> value="">None</option>
            <?php foreach ($platforms as $platformChoice): ?>
                <option <?=(isset($product) && !empty($product) && $product->platform_id == $platformChoice->platform_id) ? 'selected="selected"' : '';?> value="<?=$platformChoice->platform_id;?>"><?=htmlspecialchars(strip_tags($platformChoice->name), ENT_QUOTES, 'UTF-8');?></option>
            <?php endforeach; ?>
        </select>

        <label for="genre">Genre</label>
        <select name="product[genre_id]" id="genre">
            <option <?=(isset($product) && !empty($product) && $product->genre_id == 0) ? 'selected="selected"' : '';?> value="">None</option>
            <?php foreach ($genres as $genreChoice): ?>
                <option <?=(isset($product) && !empty($product) && $product->genre_id == $genreChoice->genre_id) ? 'selected="selected"' : '';?> value="<?=$genreChoice->genre_id;?>"><?=htmlspecialchars(strip_tags($genreChoice->name), ENT_QUOTES, 'UTF-8');?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="buttons">
        <input type="submit" name="submit" value="Submit">
    </div>
</form>