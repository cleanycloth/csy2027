<div class="results-gridcontainer">
    <div class="FilterSide">
        <h2>Filters</h2>
        <button class="dropdown-btn active">Platform <i class="fa fa-caret-down"></i></button>
        <div class="dropdown-container visible">
            <ul>
                <?php foreach ($platforms as $platform): ?>
                    <li><a href="?platform=<?=urlencode($platform->name);?>"><?=$platform->name;?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <button class="dropdown-btn active">Price Range<i class="fa fa-caret-down"></i></button>
        <div class="dropdown-container visible">
            <ul>
                <li><a href="#">£0-10</a></li>
                <li><a href="#">£11-30</a></li>
                <li><a href="#">£40-60</a></li>
            </ul>
        </div>

        <button class="dropdown-btn active">Genre<i class="fa fa-caret-down"></i></button>
        <div class="dropdown-container visible">
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
        <?php if (!empty($products)): ?>
            <p>Showing <?=$lowerAmount;?>-<?=$upperAmount;?> of <?=$totalProducts;?> product(s)</p>
            </div>

            <div class="Products">
                <?php foreach ($products as $product): ?>
                    <div class="product">
                        <a href="/product?id=<?=$product->product_id;?>">
                            <img src="<?=$product->image;?>" alt="<?=($product->image != '/images/image-placeholder.jpg') ? htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>">
                            <p><b><?=htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8');?></b></p>
                            <p>£<?=$product->price;?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="Pagecount">
                <ul>
                    <?php 
                        if (stripos($_SERVER['REQUEST_URI'], '?page='))
                            $requestUri = explode("?page=", $_SERVER['REQUEST_URI'])[0];
                        else if (stripos($_SERVER['REQUEST_URI'], '&page='))
                            $requestUri = explode("&page=", $_SERVER['REQUEST_URI'])[0]; 
                        else
                            $requestUri = $_SERVER['REQUEST_URI'];
                        
                        if (isset($_GET['page'])) {
                            $previousPageNumber = $_GET['page']-1;
                            $nextPageNumber = $_GET['page']+1;
                        }    
                        else {
                            $previousPageNumber = 0;
                            $nextPageNumber = 2;
                        }
                    ?>
                    
                    <?php if ($previousPageNumber != 0): ?>
                        <?php if (stripos($requestUri, '?') !== false || stripos($requestUri, '&') !== false): ?> 
                            <li><a href="<?=$requestUri . '&page=' . $previousPageNumber;?>"><i class="fas fa-arrow-left"></i></a></li>
                        <?php else: ?>
                            <li><a href="<?=$requestUri . '?page=' . $previousPageNumber;?>"><i class="fas fa-arrow-left"></i></a></li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php for ($i=1; $i<=$totalPages; $i++): ?>
                        <?php if (stripos($requestUri, '?') !== false || stripos($requestUri, '&') !== false): ?> 
                            <li><a href="<?=$requestUri . '&page=' . $i;?>"><?=$i;?></a></li>
                        <?php else: ?>
                            <li><a href="<?=$requestUri . '?page=' . $i;?>"><?=$i;?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($nextPageNumber <= $totalPages): ?>
                        <?php if (stripos($requestUri, '?') !== false || stripos($requestUri, '&') !== false): ?> 
                            <li><a href="<?=$requestUri . '&page=' . $nextPageNumber;?>"><i class="fas fa-arrow-right"></i></a></li>
                        <?php else: ?>
                            <li><a href="<?=$requestUri . '?page=' . $nextPageNumber;?>"><i class="fas fa-arrow-right"></i></a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </div>
        <?php else: ?>
            <p><?=$errorMsg;?></p>
        <?php endif; ?>
    </div>
</div>