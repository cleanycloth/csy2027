<?php if ($category->parent_id == null): ?>
    <?php if (count($category->getChildCategories()) > 0): //Check if the amount of rows in $childCategories is greater than 0. Used to determine if the specified category has any children. ?>
        <ul class="children">
            <?php foreach ($category->getChildCategories() as $childCategory): //Store a single row from $childCategories in $child on each iteration. ?>
                <li>
                    <article>
                        <p><b><a href="../category.php?category=<?=urlencode(strip_tags($childCategory->name));?>"><?=htmlspecialchars(strip_tags($childCategory->name), ENT_QUOTES, 'UTF-8');?></a></b></p>
                        <form action="/admin/categories/removechild" method="post">
                            <input type="hidden" name="category[parent_id]" value="<?=$_GET['id'];?>">
                            <input type="hidden" name="category[category_id]" value="<?=$childCategory->category_id?>">
                            <button><i class="fas fa-trash-alt"></i> Remove Category</button>
                        </form>    
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="msg">This category currently has no children.</p>
    <?php endif; ?>
<?php else: ?>
    <p class="msg">This category is a child of a category.</p>
<?php endif; ?>