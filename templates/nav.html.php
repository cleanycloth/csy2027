<nav class="site-nav">
    <ul>
        <?php foreach($categories as $category): ?>
            <li><a href="/category?id=<?=$category->category_id;?>"><?=$category->name;?></a></li>
        <?php endforeach; ?>
        <li class="dropdown">
            <!-- <i class="fas fa-chevron-up"></i> -->
            <a href="#">Dropdown Menu</a>
            <ul>
                <li><a href="#">Item 1</a></li>
                <li><a href="#">Item 2</a></li>
                <li><a href="#">Item 3</a></li>
            </ul>
        </li>
    </ul>
</nav>