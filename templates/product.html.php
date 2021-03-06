<h1><?=htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8');?></h1> 
<div class="productsec">  
    <div class="pcolumn">
        <div class="product-carousel slider">
            <div>
                <img src="<?=$product->image;?>" alt="<?=($product->image != '/images/image-placeholder.jpg') ? htmlspecialchars(strip_tags($product->name), ENT_QUOTES, 'UTF-8') : 'Placeholder Image';?>">
            </div>
        </div>
    </div>

    <div class="pcolumn">
        <h1>Description</h1>
        <h4>Category: <?=htmlspecialchars(strip_tags($categoryName), ENT_QUOTES, 'UTF-8');?></h4>
        <h4>Platform: <?=htmlspecialchars(strip_tags($platformName), ENT_QUOTES, 'UTF-8');?></h4>
        <h4>Genre: <?=htmlspecialchars(strip_tags($genreName), ENT_QUOTES, 'UTF-8');?></h4>

        <p><?=htmlspecialchars(strip_tags($product->description), ENT_QUOTES, 'UTF-8');?></p>
    </div>

    <div class="pcolumn">
        <div class="purchasebox">
            <h2>Price</h2>
            <p>£<?=$product->price;?></p>
            <form action="/basket/add" method="post">
                <div class="fields">
                    <input type="hidden" id="productId" value="<?=$product->product_id;?>">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" id="quantity" min="1" max="99" value="1">
                </div>
                
                <div class="buttons">
                    <button>Add To Basket</button>    
                </div>

                <output></output>
            </form>
        </div>
    </div>
</div>