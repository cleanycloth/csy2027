<div class="content">
    <h1><?=$pageName;?></h1>
    <form id="register-form" action="" method="post">
        <output><?=(isset($error)) ? $error : '';?></output>
        <p class="required">Required:</p>
        <div class="fields">    
            <!--<input type="hidden" name="user[user_id]" value="3">-->

            <label for="username" class="required">Username</label>
            <input type="text" name="user[username]" id="username" value="<?=(isset($_POST['user']['username'])) ? $_POST['user']['username'] : '';?>">

            <label for="firstname" class="required">First Name</label> 
            <input type="text" name="user[firstname]" id="firstname" value="<?=(isset($_POST['user']['firstname'])) ? $_POST['user']['firstname'] : '';?>">

            <label for="surname" class="required">Surname</label> 
            <input type="text" name="user[surname]" id="surname" value="<?=(isset($_POST['user']['surname'])) ? $_POST['user']['surname'] : '';?>">

            <label for="email" class="required">Email Address</label> 
            <input type="text" name="user[email]" id="email" value="<?=(isset($_POST['user']['email'])) ? $_POST['user']['email'] : '';?>">

            <label for="password" class="required">Password</label> 
            <input type="password" name="user[password]" id="password">

            <label for="confirm-password" class="required">Confirm Password</label> 
            <input type="password" name="user[confirm-password]" id="confirm-password">

            <label for="tos-privacy-agreement" class="required">Do you agree to our <a href="">Terms of Service</a> and <a href="">Privacy Policy</a>?</label>
            <div class="radio-buttons-row" id="tos-privacy-agreement">
                <div class="radio-button">
                    <input type="radio" name="user[tos-privacy-agreement]" id="yes" value="1">
                    <label for="yes">Yes</label>
                </div>
                <div class="radio-button">
                    <input type="radio" name="user[tos-privacy-agreement]" id="no" value="2">
                    <label for="no">No</label>
                </div>
            </div>
        </div>

        <div class="buttons">
            <input type="submit" name="submit" value="Sign up">
        </div>
        <p>Already have an account? <a href="/login">Sign in here</a>.</p>
    </form>
</div>