<h2>Categories</h2>
<a class="button" href="/admin/categories/edit">Add New Category</a>
<?php if (count($categories) > 0): //Check if the amount of rows in $parentCategories is greater than 0. Used to determine if any categories exist. ?>
    <ul class="categories">
        <?php foreach ($categories as $parentCategory): //Store a single row from $parentCategories in $parentCategory on each iteration. ?>
            <?php if ($parentCategory->parent_id == null): //Check if $parentCategory['parent_id'] is equal to null. Used to check if the category is a parent category. ?>
                <li>
                    <article class="parent <?=(count($parentCategory->getChildCategories()) > 0) ? 'dropdown' : ''; //Check if the amount of rows in $childCategories is greater than 0. If so, add the class of "dropdown" to the article element. ?>">
                        <?=(count($parentCategory->getChildCategories()) > 0) ? '<i class="fas fa-caret-down"></i>' : ''; //Check if the amount of rows in $childCategories is greater than 0. If so, add a down arrow icon inside the article element. ?>
                        <p class="category-name"><a href="../category.php?category=<?=urlencode(strip_tags($parentCategory->name));?>"><?=htmlspecialchars(strip_tags($parentCategory->name), ENT_QUOTES, 'UTF-8');?></a>
                        <p>Total Products: <?=$parentCategory->getTotalProductsCount();?></p>
                        <p><a href="/admin/categories/edit?id=<?=$parentCategory->category_id;?>"><i class="fas fa-edit"></i> Edit Category</a></p>
                        <form action="/admin/categories/delete" method="post">
                            <input type="hidden" name="category[category_id]" value="<?=$parentCategory->category_id?>">
                            <button><i class="fas fa-trash-alt"></i> Delete Category</button>
                        </form>  
                    </article>
                    <?php if (count($parentCategory->getChildCategories()) > 0): //Check if the amount of rows in $childCategories is greater than 0. Used to determine if a parent category has any child categories. ?>
                        <ul class="child-categories">
                            <?php foreach ($parentCategory->getChildCategories() as $childCategory): //Store a single row from $childCategories in $childCategory on each iteration. ?>
                            <li>
                                <article class="child">
                                    <p class="category-name"><a href="../category.php?category=<?=urlencode(strip_tags($childCategory->name));?>"><?=htmlspecialchars(strip_tags($childCategory->name), ENT_QUOTES, 'UTF-8');?></a>
                                    <p>Total Products: <?=$childCategory->getProductsCount();?></p>
                                    <p><a href="/admin/categories/edit?id=<?=$childCategory->category_id;?>"><i class="fas fa-edit"></i> Edit Category</a></p>
                                    <form action="/admin/categories/delete" method="post">
                                        <input type="hidden" name="category[category_id]" value="<?=$childCategory->category_id?>">
                                        <button><i class="fas fa-trash-alt"></i> Delete Category</button>
                                    </form>                                
                                </article>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="msg">There are currently no categories.</p>    
<?php endif; ?>