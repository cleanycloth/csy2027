<div class="checkout">
    <h1>Checkout</h1>
    <p>Review Basket > <span class="currentpage"> Address/Contact Info</span> > Payment Details > Confirm Order > Completed </p>
    <h2>Contact Information</h2>
    <form action="" method="get">
        <div class="fields">    
                <label for="title-field">Title</label>
                <select name="title-field" id="title">
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                </select>
                <label class="required" for="firstnames">First Name(s)</label> 
                <input type="text" name="firstnames" required>

                <label class="required" for="surnamme">Surname</label> 
                <input type="text" name="surname" required>

                <label class="required" for="houseno">House No</label> 
                <input type="text" name="houseno" required>

                <label class="required" for="addressline1">Address Line 1</label> 
                <input type="text" name="addressline1" required>

                <label for="addressline2">Address Line 2</label> 
                <input type="text" name="addressline2">

                <label class="required" for="towncity">Town/City</label> 
                <input type="text" name="towncity" required>

                <label class="required" for="statecounty">State/County</label> 
                <input type="text" name="statecounty" required>

                <label class="required" for="postcode">Post Code</label> 
                <input type="text" name="postcode" required>

                <label class="required" for="country">Country</label> 
                <input type="text" name="country" required>

                <label class="required" for="phone">Phone No</label>
                <input type="tel" name="phone">
        </div>
    </form>

    <h2>Billing Information</h2>
    <form action="" method="get">
        <div class="checkboxes" id="checkboxes">
            <div class="checkbox">
                <input type="checkbox" name="sameinfo" id="check-1" value="1">
                <label for="checkbox">Same as Contact Information</label>
            </div>
        </div>
        <div class="fields">    
            <label for="title-field">Title</label>
            <select name="title-field" id="title">
                <option value="Mr">Mr</option>
                <option value="Mrs">Mrs</option>
                <option value="Ms">Ms</option>
            </select>

            <label class="required" for="billfirstnames">First Name(s)</label> 
            <input type="text" name="billfirstnames" required>

            <label class="required" for="billsurnamme">Surname</label> 
            <input type="text" name="billsurname" required>

            <label class="required" for="billhouseno">House No</label> 
            <input type="text" name="billhouseno" required>

            <label class="required" for="billaddressline1">Address Line 1</label> 
            <input type="text" name="billaddressline1" required>

            <label for="billaddressline2">Address Line 2</label> 
            <input type="text" name="billaddressline2">

            <label class="required" for="billtowncity">Town/City</label> 
            <input type="text" name="billtowncity" required>

            <label class="required" for="billstatecounty">State/County</label> 
            <input type="text" name="billstatecounty" required>

            <label class="required" for="billpostcode">Post Code</label> 
            <input type="text" name="billpostcode" required>

            <label class="required" for="billcountry">Country</label> 
            <input type="text" name="billcountry" required>

            <label class="required" for="billphone">Phone No</label>
            <input type="tel" name="billphone">
        </div>
    </form>
</div>