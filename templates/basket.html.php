<div class="basket-overlay hidden" id="basket">
    <button id="basket-button"><i class="fas fa-shopping-cart"></i></button>
    <div class="basket">
        <h3 class="fixed"><i class="fas fa-shopping-cart"></i> My Basket</h3>
        <div id="basket-contents">
            <p class="msg">You have not added any items to your basket.</p>
            <hr>
            <!--
            <div class="basket-item">
                <div class="item-main-info">
                    <img src="/images/image-placeholder.jpg" alt="Placeholder Image">
                        <a class="product-name" href="/product?id=1"><h4>Placeholder Product</h4></a>
                        <form action="/basket/remove" method="post">
                            <input type="hidden" value="1">
                            <button class="delete-button"><i class="fas fa-trash-alt"></i></button>
                        </form>
                </div>
                <div class="item-price-qty-info">
                    <form action="/basket/update" method="post">
                        <input type="hidden" value="' + data[i].productId + '">
                        <label><b>Qty</b></label>
                        <input type="number" min="1" max="99" value="1">
                        <button class="update-button"><i class="fas fa-sync"></i></button>
                    </form>
                    <p>£100.00</p>
                </div>
            </div>
            -->
        </div>

        
        <div class="basket-total">
            <p><b>TOTAL</b>: £0.00</p>
            <a class="button" href="#">Checkout</a>
        </div>
    </div>
</div>