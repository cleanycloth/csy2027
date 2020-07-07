<div class="results-gridcontainer">
    <div class="FilterSide">
        <h2>Filters</h2>
        <button class="dropdown-btn active">Platform <i class="fa fa-caret-down"></i></button>
        <div class="dropdown-container" style="display: block;">
            <ul>
                <?php foreach ($platforms as $platform): ?>
                    <li><a href="?platform=<?=urlencode($platform->name);?>"><?=$platform->name;?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <button class="dropdown-btn active">Price Range<i class="fa fa-caret-down"></i></button>
        <div class="dropdown-container" style="display: block;">
            <ul>
                <li><a href="#">£0-10</a></li>
                <li><a href="#">£11-30</a></li>
                <li><a href="#">£40-60</a></li>
            </ul>
        </div>

        <button class="dropdown-btn active">Genre<i class="fa fa-caret-down"></i></button>
        <div class="dropdown-container" style="display: block;">
            <ul>
                <?php foreach ($genres as $genre): ?>
                    <li><a href="?genre=<?=urlencode($genre->name);?>"><?=$genre->name;?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="ResultSide">
        <div class="Title">
        <h1><?=$pageName;?></h1>
        <?php if (!empty($products) && count($products) > 0): ?>
            <p>Showing <?=$lowerAmount;?>-<?=$upperAmount;?> of <?=$totalProducts;?> product(s)</p>
            </div>

            <div class="Products">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <a href="/product?id=<?=$product->product_id;?>">
                            <img src="<?=$product->image;?>" alt="<?=($product->image != '/images/image-placeholder.jpg') ? htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>">
                            <p><?=$product->name;?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p><?=$errorMsg;?></p>
        <?php endif; ?>
    </div>
</div>