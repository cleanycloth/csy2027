<div class="main-carousel slider">
    <?php if (count($slides) > 0): ?>
        <?php foreach ($slides as $slide): ?>
            <div>
                <a href="<?=htmlspecialchars(strip_tags($slide->url), ENT_QUOTES, 'UTF-8');?>">
                    <img src="<?=($slide->image_id != null) ? '/image?id=' . $slide->image_id : '/images/image-slide-placeholder.jpg';?>" alt="<?=($slide->image_id != null) ? htmlspecialchars(strip_tags($slide->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>">
                    <p><?=htmlspecialchars(strip_tags($slide->message), ENT_QUOTES, 'UTF-8');?></p>
                </a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div>
            <a href="/">
                <img src="/images/welcome-to-nngames.jpg" alt="Welcome to NNGames!">
                <p>Welcome to NNGames!</p>
            </a>
        </div>
    <?php endif; ?>
</div>

<h1>LATEST PRODUCTS</h1>
<div class="featured-product-carousel slider">
    <?php $reversedProducts = array_reverse($products);?>
    <?php for ($i=0; $i<count($reversedProducts) && $i<10; $i++): ?>
        <div>
            <a href="/product?id=<?=$reversedProducts[$i]->product_id;?>">
                <img src="<?=($reversedProducts[$i]->image_id != null) ? '/image?id=' . $reversedProducts[$i]->image_id : '/images/image-placeholder.jpg';?>" alt="<?=($reversedProducts[$i]->image_id != null) ? htmlspecialchars(strip_tags($reversedProducts[$i]->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>">
                <p><?=htmlspecialchars(strip_tags($reversedProducts[$i]->name), ENT_QUOTES, 'UTF-8');?></p>
            </a>
        </div>
    <?php endfor; ?>
</div>

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