
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

        <!-- Main -->
        <main class="site-main">
            <div class="content">
                <h1>Sign In</h1>
                <form action="" method="post">
                    <output>ERROR</output>
                    <div class="fields">    
                        <label for="username">Username/Email Address</label> 
                        <input type="text" name="username">

                        <label for="password">Password</label> 
                        <input type="password" name="password">
                    </div>

                    <div class="buttons">
                        <input type="button" value="Sign in">
                    </div>
                    
                    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
                </form>
            </div>
        </main>

        <!-- Footer -->
        <footer class="site-footer">
            Copyright &copy; <?=date('Y');?> NNGames - All Rights Reserved
        </footer>

        <!-- jQuery - https://jquery.com/ -->
        <script type="text/javascript" src="js/jquery/jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="js/jquery/jquery-migrate-1.4.1.min.js"></script>
        <!-- Slick Slider - https://kenwheeler.github.io/slick/ -->
        <script type="text/javascript" src="js/slick/slick.min.js"></script>
        <script type="text/javascript" src="js/carousels.js"></script>
    </body>
</html>