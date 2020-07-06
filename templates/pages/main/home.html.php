<div class="main-carousel slider">
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/1920x500" alt="Placeholder Image">
            <p>Slide 1</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/1920x500" alt="Placeholder Image">
            <p>Slide 2</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/1920x500" alt="Placeholder Image">
            <p>Slide 3</p>
        </a>
    </div>
</div>

<h1>LATEST PRODUCTS</h1>
<div class="featured-product-carousel slider">
    <?php $reversedProducts = array_reverse($products);?>
    <?php for ($i=0; $i<count($reversedProducts) && $i<10; $i++): ?>
        <div>
            <a href="/product?id=<?=$reversedProducts[$i]->product_id;?>">
                <img src="/image?id=<?=$reversedProducts[$i]->image_id;?>" alt="<?=htmlspecialchars(strip_tags($reversedProducts[$i]->name), ENT_QUOTES, 'UTF-8');?>">
                <p><?=htmlspecialchars(strip_tags($reversedProducts[$i]->name), ENT_QUOTES, 'UTF-8');?></p>
            </a>
        </div>
    <?php endfor; ?>
    <!--  
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 1</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 2</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 3</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 4</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 5</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 6</p>
        </a>
    </div>
    -->
</div>

<!--
<h1>STAFF PICKS</h1>
<div class="featured-product-carousel slider">
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 1</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 2</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 3</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 4</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 5</p>
        </a>
    </div>
    <div>
        <a href="#">
            <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
            <p>Product 6</p>
        </a>
    </div>
</div>
-->

<div class="featured">
    <div class="featured-item">
        <img src="https://via.placeholder.com/390x270" alt="Placeholder Image">
        <p>Featured Item 1</p>
        <a href="#">Shop all</a>
    </div>
    <div class="featured-item">
        <img src="https://via.placeholder.com/390x270" alt="Placeholder Image">
        <p>Featured Item 2</p>
        <a href="#">Pre-order now</a>
    </div>
    <div class="featured-item">
        <img src="https://via.placeholder.com/390x270" alt="Placeholder Image">
        <p>Featured Item 3</p>
        <a href="#">Find out more</a>
    </div>
</div>