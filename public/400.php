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
            <div class="#">
                <p class="errorcode" style="font-size:72px;">400: Bad Request</p>
                <p class="errorcode" style="font-size:34px;">Something went wrong. Please try again.</p>
                <!--<img class="errorimage" src="images/hal.png" alt="Picture of HAL9000.">-->
            </div>

        </main>

        <!-- Footer -->
        <footer class="site-footer">
            &copy; <?=date("Y");?> NN Games - All Rights Reserved
        </footer>
    </body>
</html>

