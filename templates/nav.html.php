<nav class="site-nav">
    <ul>
        <?php foreach ($categories as $category): ?>
            <?php if (count($category->getChildCategories()) > 0): ?>
                <li class="dropdown">
                    <a href="/products?category=<?=urlencode($category->name);?>"><?=$category->name;?></a>
                    <ul>
                        <?php foreach($category->getChildCategories() as $childCategory): ?>
                            <li><a href="/products?category=<?=urlencode($childCategory->name);?>"><?=$childCategory->name;?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php elseif ($category->parent_id == null && count($category->getChildCategories()) == 0): ?>
                <li><a href="/products?category=<?=urlencode($category->name);?>"><?=$category->name;?></a></li>
            <?php endif;?>
        <?php endforeach; ?>
    </ul>
</nav>