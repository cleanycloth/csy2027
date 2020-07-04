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
                <h1>Sign Up</h1>
                <form action="" method="post">
                    <output>ERROR</output>
                    <p class="required">Required:</p>
                    <div class="fields">    
                        <label for="username" class="required">Username</label>
                        <input type="text" name="username">

                        <label for="firstname" class="required">First Name</label> 
                        <input type="text" name="firstname">
  
                        <label for="surname" class="required">Surname</label> 
                        <input type="text" name="surname">

                        <label for="email" class="required">Email Address</label> 
                        <input type="text" name="email">
 
                        <label for="password" class="required">Password</label> 
                        <input type="password" name="password">

                        <label for="confirm-password" class="required">Confirm Password</label> 
                        <input type="password" name="confirm-password">
         
                        <label for="tos-privacy-agreement" class="required">Do you agree to our <a href="">Terms of Service</a> and <a href="">Privacy Policy</a>?</label>
                        <div class="radio-buttons-row" id="tos-privacy-agreement">
                            <div class="radio-button">
                                <input type="radio" name="tos-privacy-choice" id="yes1" value="1">
                                <label for="yes1">Yes</label>
                            </div>
                            <div class="radio-button">
                                <input type="radio" name="tos-privacy-choice" id="no1" value="2">
                                <label for="no1">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="buttons">
                        <input type="submit" name="submit" value="Sign up">
                    </div>
                    <p>Already have an account? <a href="login.php">Sign in here</a>.</p>
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
        <script type="text/javascript" src="js/javascript.js"></script>
    </body>
</html>