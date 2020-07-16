<form id="edit-user-form" action="" method="post">
    <h2>Account Settings</h2>
    <output><?=(isset($error)) ? $error : '';?></output>
    <p class="required">Required:</p>
    <div class="fields">    
        <?php if (isset($_GET['id'])): ?>
            <input type="hidden" name="user[user_id]" value="<?=$user->user_id;?>">
        <?php endif; ?>
        
         <label for="username">Username</label>
        <input type="text" name="user[username]" id="username" value="<?=$_SESSION['username']?>" disabled>

        <label for="firstname" class="required">First Name</label> 
        <input type="text" name="user[firstname]" id="firstname" value="John">

        <label for="surname" class="required">Surname</label> 
        <input type="text" name="user[surname]" id="surname" value="Appleseed">

        <label for="email" class="required">Email Address</label> 
        <input type="text" name="user[email]" id="email" value="j.appleseed@icloud.com">

        <label for="password">Password</label> 
        <input type="password" name="user[password]" id="password">
    </div>

    <div class="buttons">
        <input type="submit" name="submit" value="Submit">
    </div>
</form>