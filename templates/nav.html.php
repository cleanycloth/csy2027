<nav class="site-nav">
    <ul>
        <?php foreach($categories as $category): ?>
            <?php if (empty($category->parent_id)):?>
                <li class="dropdown">
                <a href="/category?id=<?=$category->category_id;?>"><?=$category->name;?></a>
                <ul>
                    <?php foreach($category->getChildCategories() as $childCategory): ?>
                        <li><a href="/category?id=<?=$childCategory->category_id;?>"><?=$childCategory->name;?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php endif;?>
        <?php endforeach; ?>
    </ul>
</nav>