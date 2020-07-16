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
        <?php require 'basket.html.php'; ?>

        <!-- Header -->
        <?php require 'header.html.php'; ?>

        <!-- Navigation Bar -->
        <?php require 'nav.html.php'; ?>

        <!-- Main -->
        <main class="site-main">
            <div class="content">
                <h1>My Account</h1>

                <!-- Admin Navigation Bar -->
                <?php require 'accountnav.html.php'; ?>

                <div class="admin-content">
                    <?=$output;?>
                </div>
            </div>
        </main>

        <!-- Return To Top Button -->
        <a class="return-to-top hide" id="return-to-top" href="#top"><i class="fas fa-arrow-up"></i></a>

        <!-- Footer -->
        <?php require 'footer.html.php'; ?>

        <!-- Scripts -->
        <?php require 'scripts.html.php'; ?>
    </body>
</html>