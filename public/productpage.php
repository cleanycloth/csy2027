<!DOCTYPE html>
<html>
    <head>
       <link rel="stylesheet" type="text/css" href="js/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="js/slick/slick-theme.css"/>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link rel="stylesheet" type="text/css" href="styles/fonts.css">
        <!-- Font Awesome Icons - https://fontawesome.com/ -->
        <script src="https://kit.fontawesome.com/04ac565eb5.js" crossorigin="anonymous"></script>
        <title>NN Games - Product Name</title>
    </head>

    <body>
        <!-- Header -->
        <header class="site-header">
            <div class="logo">
                <a href="/csy2027"><h1>NN Games</h1></a>
            </div>

            <!-- search bar  -->
          

            <div class="user-options">
                <!-- Signed Out -->
                <!-- 
                <ul>
                    <li><a href="#">Sign in</a></li> |
                    <li><a href="#">Register</a></li>
                </ul>
                -->

                <!-- Signed In -->
                <!--
                <ul>
                    <p>Welcome, user!</p> |
                    <li><a href="#">My Account</a></li> |
                    <li><a href="#">Sign out</a></li>
                </ul>
                -->
            </div>
        </header>

        <!-- Navigation Bar -->
        <nav class="site-nav">
            <ul>
                <li><a href="#">PlayStation</a></li>
                <li><a href="#">Xbox</a></li>
                <li><a href="#">Nintendo</a></li>
                <li><a href="#">PC</a></li>
                <li><a href="#">Pre-Owned</a></li>
                <li><a href="#">Accessories</a></li> 
            </ul>
        </nav>

        <!-- Main -->
        <main class="site-main">
        <section>
        <h2>Product Name<h2> 
        <div class="productsec">  
            <div class="pcolumn">
            <div class="product-carousel slider">
                <div>
                        <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                </div>
                <div>
                        <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                </div>
                <div>
                        <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                </div>
            </div>
            </div>
            <div class="pcolumn">
            <h1>Description</h1>
            <h3>Platform: Platform</h3>
            <h3>Genre: Genre</h3>

            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="pcolumn">
                <div class ="purchasebox">
                <p> Price : £50.00 </p>
                <a href="#">Add to basket</a>
                </div>
            </div>
        </div>
        </section>

        </main>

        <!-- Footer -->
        <footer class="site-footer">
            &copy; <?=date("Y");?> NN Games - All Rights Reserved
        </footer>

        
         <!-- jQuery - https://jquery.com/ -->
         <script type="text/javascript" src="js/jquery/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/jquery/jquery-migrate-1.4.1.min.js"></script>
        <!-- Slick Slider - https://kenwheeler.github.io/slick/ -->
        <script type="text/javascript" src="js/slick/slick.min.js"></script>
        <script type="text/javascript" src="js/carousels.js"></script>
    </body>
</html>