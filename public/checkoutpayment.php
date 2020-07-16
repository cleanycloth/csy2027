<!DOCTYPE html>
<html>
    <head>
        <!-- Font Awesome Icons - https://fontawesome.com/ -->
        <script src="https://kit.fontawesome.com/04ac565eb5.js" crossorigin="anonymous"></script>
        <!-- Slick Slider Styling - https://kenwheeler.github.io/slick/ -->
        <link rel="stylesheet" type="text/css" href="js/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="js/slick/slick-theme.css"/>
        <!-- NN Games Stylesheets -->
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link rel="stylesheet" type="text/css" href="styles/fonts.css">
        <title>NN Games - Page Name</title>
    </head>

    <body>
        <!-- Header -->
        <header class="site-header">    
            <div class="logo">
                <a href="/"><h1>NN Games</h1></a>
            </div>

            <div class="search">
                <form action="" method="get">
                    <input type="search" name="search" placeholder="Search">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="user-options">
                <!-- Signed Out -->
                <!--
                <ul>
                    <li><a href="#">Sign in <i class="fas fa-sign-in-alt"></i></a></li> |
                    <li><a href="#">Register <i class="fas fa-user-plus"></i></a></li>
                </ul>
                -->

                <!-- Signed In -->
                <ul>
                    <p>Welcome, user!</p> |
                    <li><a href="#">My Account <i class="fas fa-user"></i></a></li> |
                    <li><a href="#">Admin Panel <i class="fas fa-cog"></i></a></li> |
                    <li><a href="#">Sign out <i class="fas fa-sign-out-alt"></i></a></li>
                </ul>
            </div>
        </header>

        <!-- Navigation Bar -->
        <nav class="site-nav">
            <ul>
                <li><a href="#">Xbox</a></li>
                <li><a href="#">Nintendo</a></li>
                <li><a href="#">PC</a></li>
                <li><a href="#">Pre-Owned</a></li>
                <li><a href="#">Accessories</a></li> 
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
<main>
<div class="checkout">
    <h1>Checkout</h1>
    <p>Review Basket > Address/Contact Info > <span class =currentpage>Payment Details </span> > Confirm Order > Completed </p>
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
</main>