<!DOCTYPE html>
<html>
    <head>
        <!-- Font Awesome Icons - https://fontawesome.com/ -->
        <script src="https://kit.fontawesome.com/04ac565eb5.js" crossorigin="anonymous"></script>
        <!-- Slick Slider Styling - https://kenwheeler.github.io/slick/ -->
        <link rel="stylesheet" type="text/css" href="/js/slick/slick.css"/>
        <link rel="stylesheet" type="text/css" href="/js/slick/slick-theme.css"/>
        <!-- NN Games Stylesheets -->
        <link rel="stylesheet" type="text/css" href="/styles/style.css">
        <link rel="stylesheet" type="text/css" href="/styles/fonts.css">
        <title>NNGames - <?=$title;?></title>
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
            <?php require 'header.html.php'; ?>
        </header>

        <!-- Navigation Bar -->
        <nav class="site-nav">
            <?php require 'nav.html.php'; ?>
        </nav>

        <!-- Main -->
        <main class="site-main">
            <?=$output;?>
        </main>

        <!-- Return To Top Button -->
        <a class="return-to-top hide" id="return-to-top" href="#top"><i class="fas fa-arrow-up"></i></a>

        <!-- Footer -->
        <footer class="site-footer">
            <?php require 'footer.html.php'; ?>
        </footer>

        <!-- jQuery - https://jquery.com/ -->
        <script type="text/javascript" src="/js/jquery/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="/js/jquery/jquery-migrate-1.4.1.min.js"></script>
        <!-- Slick Slider - https://kenwheeler.github.io/slick/ -->
        <script type="text/javascript" src="/js/slick/slick.min.js"></script>
        <script type="text/javascript" src="/js/javascript.js"></script>
    </body>
</html>