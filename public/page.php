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
                <h1>Heading</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos laudantium delectus enim amet modi voluptas blanditiis rerum, dolore, sed dignissimos consectetur id, voluptatibus voluptates vel! Commodi hic eligendi aspernatur labore delectus amet rerum atque ducimus perferendis, earum vitae officiis optio iusto dignissimos nostrum mollitia, eos maiores adipisci sequi similique? Laboriosam.</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos laudantium delectus enim amet modi voluptas blanditiis rerum, dolore, sed dignissimos consectetur id, voluptatibus voluptates vel! Commodi hic eligendi aspernatur labore delectus amet rerum atque ducimus perferendis, earum vitae officiis optio iusto dignissimos nostrum mollitia, eos maiores adipisci sequi similique? Laboriosam.</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eos laudantium delectus enim amet modi voluptas blanditiis rerum, dolore, sed dignissimos consectetur id, voluptatibus voluptates vel! Commodi hic eligendi aspernatur labore delectus amet rerum atque ducimus perferendis, earum vitae officiis optio iusto dignissimos nostrum mollitia, eos maiores adipisci sequi similique? Laboriosam.</p>
            
                <h1>Example Form</h1>
                <form action="" method="get">
                    <output>ERROR</output>
                    <div class="fields">    
                        <label for="text-field">Text Field</label> 
                        <input type="text" name="text-field">

                        <label class="required" for="text-field2">Required Text Field</label> 
                        <input type="text" name="text-field2" required>

                        <label for="password-field">Password Field</label> 
                        <input type="password" name="password-field">

                        <label for="email-field">Email Field</label> 
                        <input type="email" name="email-field">

                        <label for="date-field">Date Field</label> 
                        <input type="date" name="date-field">

                        <label for="time-field">Time Field</label> 
                        <input type="time" name="time-field">

                        <label for="upload-field">Upload Field</label>
                        <input type="file" name="upload-field" id="upload-field">

                        <label for="phone-field">Phone Field</label>
                        <input type="tel" name="phone-field">

                        <label for="url-field">URL Field</label>
                        <input type="url" id="url-field">
                        
                        <label for="number-field">Number Field</label>
                        <input type="number" id="number-field">

                        <label for="card-date">Card Date</label>
                        <div class="card-date" id="card-date">
                            <input type="text" name="expiry-month"> /
                            <input type="text" name="expiry-year">
                        </div>

                        <label for="radio-buttons">Make a choice</label>
                        <div class="radio-buttons" id="radio-buttons">
                            <div class="radio-button">
                                <input type="radio" name="radio-choice" id="radio-1" value="1">
                                <label for="radio-1">Radio Button Field</label>
                            </div>
                            <div class="radio-button">
                                <input type="radio" name="radio-choice" id="radio-2" value="2">
                                <label for="radio-2">Radio Button Field</label>
                            </div>
                            <div class="radio-button">
                                <input type="radio" name="radio-choice" id="radio-3" value="3">
                                <label for="radio-3">Radio Button Field</label>
                            </div>
                        </div>

                        <label for="checkboxes">Select some options</label>
                        <div class="checkboxes" id="checkboxes">
                            <div class="checkbox">
                                <input type="checkbox" name="checkbox-choice" id="check-1" value="1">
                                <label for="check-1">Checkbox Field</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="checkbox-choice" id="check-2" value="2">
                                <label for="check-2">Checkbox Field</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="checkbox-choice" id="check-3" value="3">
                                <label for="check-3">Checkbox Field</label>
                            </div>
                        </div>

                        <label for="radio-buttons2">Make a choice</label>
                        <div class="radio-buttons-row" id="radio-buttons2">
                            <div class="radio-button">
                                <input type="radio" name="radio-choice" id="radio-1" value="1">
                                <label for="radio-1">Radio Button Field</label>
                            </div>
                            <div class="radio-button">
                                <input type="radio" name="radio-choice" id="radio-2" value="2">
                                <label for="radio-2">Radio Button Field</label>
                            </div>
                            <div class="radio-button">
                                <input type="radio" name="radio-choice" id="radio-3" value="3">
                                <label for="radio-3">Radio Button Field</label>
                            </div>
                        </div>
                        
                        <label for="checkboxes2">Select some options</label>
                        <div class="checkboxes-row" id="checkboxes2">
                            <div class="checkbox">
                                <input type="checkbox" name="checkbox-choice" id="check-1" value="1">
                                <label for="check-1">Checkbox Field</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="checkbox-choice" id="check-2" value="2">
                                <label for="check-2">Checkbox Field</label>
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" name="checkbox-choice" id="check-3" value="3">
                                <label for="check-3">Checkbox Field</label>
                            </div>
                        </div>

                        <label for="textarea-field">Textarea Field</label> 
                        <textarea name="textarea-field"></textarea>
                    </div>
                    <input type="submit" name="submit" value="Submit Button">
                    <button type="reset">Reset Button</button>

                    <div class="buttons">
                        <input type="button" value="Button">
                        <button>Button</button>
                    </div>

                    <p>Already have an account? You can login <a href="">here</a>.</p>
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