<div class="checkout">
    <h1>Checkout</h1>
    <p>Review Basket > Address/Contact Info > <span class="currentpage">Payment Details </span> > Confirm Order > Completed </p>
    <h2>Payment Type</h2>
    <form action="" method="get">
             <div class="fields">    
                        <div class="checkboxes-row" id="paymentmenthod">
                            <div class="checkbox">
                                <input type="checkbox" name="checkbox-choice" id="check-1" value="1">
                                <label for="check-1">Pay By Card</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="checkbox-choice" id="check-2" value="2">
                                <label for="check-2">PayPal</label>
                            </div>
                        </div>
                </div>
    </form>

    <h2>Payment Details</h2>
    <form action="" method="get">
            <div class="fields">    
                <label class="required" for="fullname">Name on Card</label> 
                <input type="text" name="fullname" required>
                <label class="required" for="cardnumber">Card Number</label>
                <input type="number" id="cardnumber"required>

                <label class ="required" for="cardexpiry">Expiry</label>
                <div class="card-date" id="cardexpiry">
                        <input type="text" name="expiry-month"> /
                        <input type="text" name="expiry-year">
                </div>
                <label class="required" for="cvv">CVV</label>
                <input type="number" id="cvv"required>
            </div>
    </form>
</div>