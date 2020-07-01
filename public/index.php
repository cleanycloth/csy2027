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

        <!-- Basket Overlay -->
        <div class="basket-overlay hidden" id="basket">
            <button id="basket-button"><i class="fas fa-shopping-cart"></i></button>
            <div class="basket">
                <h3><i class="fas fa-shopping-cart"></i> My Basket</h3>
                <div class="basket-item">
                    <div class="item-main-info">
                        <img src="https://via.placeholder.com/100x100" alt="Placeholder Image">
                        <h4>Product Name</h4>
                        <a class="delete" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    <div class="item-price-qty-info">
                        <p><b>Qty</b>:
                            <form action="" method="post">
                                <input type="number" min="1" value="1"><button class="update-button"><i class="fas fa-sync"></i></button>
                            </form>
                        </p>
                        <p>£40.00</p>
                    </div>
                </div>
                <hr>
                <div class="basket-item">
                    <div class="item-main-info">
                        <img src="https://via.placeholder.com/100x100" alt="Placeholder Image">
                        <h4>Product Name</h4>
                        <a class="delete" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    <div class="item-price-qty-info">
                        <p><b>Qty</b>:
                            <form action="" method="post">
                                <input type="number" min="1" value="1"><button class="update-button"><i class="fas fa-sync"></i></button>
                            </form>
                        </p>
                        <p>£40.00</p>
                    </div>
                </div>
                <hr>
                <div class="basket-item">
                    <div class="item-main-info">
                        <img src="https://via.placeholder.com/100x100" alt="Placeholder Image">
                        <h4>Product Name</h4>
                        <a class="delete" href="#"><i class="fas fa-trash-alt"></i></a>
                    </div>
                    <div class="item-price-qty-info">
                        <p><b>Qty</b>:
                            <form action="" method="post">
                                <input type="number" min="1" value="1"><button class="update-button"><i class="fas fa-sync"></i></button>
                            </form>
                        </p>
                        <p>£40.00</p>
                    </div>
                </div>

                <div class="basket-total">
                    <p><b>TOTAL</b>: £200.00</p>
                    <a class="button" href="#">Checkout</a>
                </div>
            </div>
        </div>

        <!-- Header -->
        <header class="site-header" id=>    
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

        <!-- Main -->
        <main class="site-main">
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
            
            <h1>LATEST RELEASES</h1>
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
        </main>

        <!-- Return To Top Button -->
        <a class="return-to-top hide" id="return-to-top" href="#top"><i class="fas fa-arrow-up"></i></a>

        <!-- Footer -->
        <footer class="site-footer">
            Copyright &copy; <?=date('Y');?> NNGames - All Rights Reserved
        </footer>

        <!-- jQuery - https://jquery.com/ -->
        <script type="text/javascript" src="js/jquery/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/jquery/jquery-migrate-1.4.1.min.js"></script>
        <!-- Slick Slider - https://kenwheeler.github.io/slick/ -->
        <script type="text/javascript" src="js/slick/slick.min.js"></script>
        <script type="text/javascript" src="js/javascript.js"></script>
    </body>
</html>