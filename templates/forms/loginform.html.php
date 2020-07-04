<div class="content">
    <h1>Sign In</h1>
    <form action="" method="post">
        <output><?=(isset($error)) ? $error : '';?></output>
        <div class="fields">    
            <label for="username">Username</label> 
            <input type="text" name="login[username]" id="username">

            <label for="password">Password</label> 
            <input type="password" name="login[password]" id="password">
        </div>

        <div class="buttons">
            <input type="submit" name="submit" value="Sign in">
        </div>
        
        <p>Don't have an account? <a href="/register">Sign up now</a>.</p>
    </form>
</div>