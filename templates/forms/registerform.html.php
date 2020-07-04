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
        <p>Already have an account? <a href="/login">Sign in here</a>.</p>
    </form>
</div>