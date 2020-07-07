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
        <main class="site-main">

        <div class="results-gridcontainer">

            <div class="FilterSide">
                <h2>Filters</h2>
                <button class="dropdown-btn">Platform
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                <ul>
                <li><a href="#">PS4</a></li>
                <li><a href="#">Xbox One</a></li>
                <li><a href="#">Nintendo Switch</a></li>
                <li><a href="#">3DS</a></li>
                <li><a href="#">PC</a></li>
                <li><a href="#">PS3</a></li>
                <li><a href="#">Xbox 360</a></li>
                </ul>
                </div>
                <button class="dropdown-btn">Price Range
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                <ul>
                <li><a href="#">£0-10</a></li>
                <li><a href="#">£11-30</a></li>
                <li><a href="#">£40-60</a></li>
                </ul>
                </div>
                <button class="dropdown-btn">Genre
                <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-container">
                <ul>
                <li><a href="#">Action</a></li>
                <li><a href="#">Adventure</a></li>
                <li><a href="#">Beat 'em Up</a></li>
                <li><a href="#">First Person Shooter</a></li>
                <li><a href="#">MMORPG</a></li>
                <li><a href="#">Puzzle</a></li>
                <li><a href="#">Third Person Shooter</a></li>
                </ul>
                </div>
            </div>

            <div class="ResultSide">

                <div class="Title">
                <h1>Category Name</h1>
                <p>Showing 1-9 of 27 products</p>
                </div>

                <div class="Products">

                    <div>
                    <a href= #>
                    <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                    <p>Product 1</p>
                    </a>
                    </div>

                    <div>
                    <a href= #>
                    <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                    <p>Product 2</p>
                    </a>
                    </div>

                    <div>
                    <a href= #>
                    <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                    <p>Product 3</p>
                    </a>
                    </div>

                    <div>
                    <a href= #>
                    <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                    <p>Product 4</p>
                    </a>
                    </div>

                    <div>
                    <a href= #>
                    <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                    <p>Product 5</p>
                    </a>
                    </div>

                    <div>
                    <a href= #>
                    <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                    <p>Product 6</p>
                    </a>
                    </div>

                    <div>
                    <a href= #>
                    <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                    <p>Product 7</p>
                    </a>
                    </div>

                    <div>
                    <a href= #>
                    <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                    <p>Product 8</p>
                    </a>
                    </div>

                    <div>
                    <a href= #>
                    <img src="https://via.placeholder.com/200x200" alt="Placeholder Image">
                    <p>Product 9</p>
                    </a>
                    </div>
                </div>
            </div>
        
        </div>
    </main>
    <script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>