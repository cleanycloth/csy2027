<form id="register-form" action="" method="post">
    <h2><?=$pageName;?></h2>
    <output><?=(isset($error)) ? $error : '';?></output>
    <p class="required">Required:</p>
    <div class="fields">    
        <input type="hidden" name="user[user_id]" value="<?=(isset($_GET['id'])) ? $user->user_id : '';?>">

        <label for="username" class="required">Username</label>
        <input type="text" name="user[username]" id="username" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($user->username), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['user'])) { echo $_POST['user']['username']; } ?>" <?=(isset($_GET['id'])) ? 'readonly' : '';?>>

        <label for="firstname" class="required">First Name</label> 
        <input type="text" name="user[firstname]" id="firstname" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($user->firstname), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['user'])) { echo $_POST['user']['firstname']; } ?>">

        <label for="surname" class="required">Surname</label> 
        <input type="text" name="user[surname]" id="surname" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($user->surname), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['user'])) { echo $_POST['user']['surname']; } ?>">

        <label for="email" class="required">Email Address</label> 
        <input type="text" name="user[email]" id="email" value="<?php if (isset($_GET['id'])) { echo htmlspecialchars(strip_tags($user->email), ENT_QUOTES, 'UTF-8'); } elseif (isset($_POST['user'])) { echo $_POST['user']['email']; } ?>">

        <label for="password" <?=(isset($_GET['id'])) ? '' : 'class="required"';?>>Password</label> 
        <input type="password" name="user[password]" id="password">

        <label for="user-type">User Type</label>
        <select name="user[user_type]" id="user-type" <?=($_GET['id'] != $_SESSION['id']) ? '' : 'disabled';?>>
            <option <?=(isset($_GET['id']) && $user->user_type == 0) ? 'selected="selected"' : '';?> value="0">Customer</option>
            <option <?=(isset($_GET['id']) && $user->user_type == 1) ? 'selected="selected"' : '';?> value="1">Administrator</option>
        </select>

        <label for="activated">Activated</label>
        <select name="user[activated]" id="activated" <?=($_GET['id'] != $_SESSION['id']) ? '' : 'disabled';?>>
            <option <?=(isset($_GET['id']) && $user->activated == 0) ? 'selected="selected"' : '';?> value="0">False</option>
            <option <?=(isset($_GET['id']) && $user->activated == 1) ? 'selected="selected"' : '';?> value="1">True</option>
        </select>
    </div>

    <div class="buttons">
        <input type="submit" name="submit" value="Submit">
    </div>
</form>