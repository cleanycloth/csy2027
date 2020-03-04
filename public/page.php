<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/style.css">
        <link rel="stylesheet" type="text/css" href="styles/fonts.css">
        <!-- Font Awesome Icons - https://fontawesome.com/ -->
        <script src="https://kit.fontawesome.com/04ac565eb5.js" crossorigin="anonymous"></script>
        <title>NN Games - Page Name</title>
    </head>

    <body>
        <!-- Header -->
        <header class="site-header">
            <div class="logo">
                <a href="/csy2027"><h1>NN Games</h1></a>
            </div>

            <div class="search">

            </div>

            <div class="user-options">
                <!-- Signed Out -->
                <ul>
                    <li><a href="#">Sign in <i class="fas fa-sign-in-alt"></i></a></li> |
                    <li><a href="#">Register <i class="fas fa-user-plus"></i></a></li>
                </ul>

                <!-- Signed In -->
                <!--
                <ul>
                    <p>Welcome, user!</p> |
                    <li><a href="#">My Account <i class="fas fa-user"></i></a></li> |
                    <li><a href="#">Sign out <i class="fas fa-sign-out-alt"></i></a></li>
                </ul>
                -->
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
                    <a href="#">Dropdown</a>
                    <ul>
                        <li><a href="#">Item 1</a></li>
                        <li><a href="#">Item 2</a></li>
                        <li><a href="#">Item 3</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Main -->
        <h1>Testing Heading</h1>
        <main class="site-main">
            <div class="featured">
                <div class="featured-item">
                    <img src="https://via.placeholder.com/325x200" alt="Placeholder Image">
                    <p>Featured Group 1</p>
                    <a href="#">Show all</a>
                </div>
                <div class="featured-item">
                    <img src="https://via.placeholder.com/325x200" alt="Placeholder Image">
                    <p>Featured Group 2</p>
                    <a href="#">Show all</a>
                </div>
                <div class="featured-item">
                    <img src="https://via.placeholder.com/325x200" alt="Placeholder Image">
                    <p>Featured Group 3</p>
                    <a href="#">Show all</a>
                </div>
            </div>

        <footer class="site-footer">
            Copyright &copy; <?=date('Y');?> NNGames - All Rights Reserved
        </footer>
    </body>
