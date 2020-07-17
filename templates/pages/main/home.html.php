<div class="main-carousel slider">
    <?php if (count($slides) > 0): ?>
        <?php foreach ($slides as $slide): ?>
            <div>
                <a href="<?=htmlspecialchars(strip_tags($slide->url), ENT_QUOTES, 'UTF-8');?>">
                    <img src="<?=$slide->image;?>" alt="<?=($slide->image != '/images/image-slide-placeholder.jpg') ? htmlspecialchars(strip_tags($slide->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>">
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
                <img src="<?=$reversedProducts[$i]->image;?>" alt="<?=($reversedProducts[$i]->image != '/images/image-placeholder.jpg') ? htmlspecialchars(strip_tags($reversedProducts[$i]->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>">
                <p><b><?=htmlspecialchars(strip_tags($reversedProducts[$i]->name), ENT_QUOTES, 'UTF-8');?></b></p>
                <p>£<?=$reversedProducts[$i]->price;?></p>
            </a>
        </div>
    <?php endfor; ?>
</div>

<div class="featured">
    <div class="featured-item">
        <img src="/images/retro-game-cartridges.jpg" alt="Retro game catridges">
        <p>Retro Games</p>
        <a href="#">Show All</a>
    </div>
    <div class="featured-item">
        <img src="/images/tech-products.jpg" alt="An assortment of tech products">
        <p>Pre-Owned Tech</p>
        <a href="#">Show All</a>
    </div>
    <div class="featured-item">
        <img src="/images/virtual-reality-kid.jpg" alt="Kid with Virtual Reality Headset">
        <p>Virtual Reality</p>
        <a href="#">Show All</a>
    </div>
</div>