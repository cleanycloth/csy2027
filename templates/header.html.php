<header class="site-header">    
    <div class="logo">
        <a href="/"><h1>NNGames</h1></a>
    </div>

    <div class="search">
        <form action="/products" method="get">
            <input type="search" name="search" placeholder="Search" value="<?=(isset($_GET['search'])) ? $_GET['search'] : '';?>">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <div class="user-options">
        <?php if (!isset($_SESSION['isLoggedIn'])): ?>
            <!-- Signed Out -->
            <ul>
                <li><a href="/login">Sign In <i class="fas fa-sign-in-alt"></i></a></li> |
                <li><a href="/register">Register <i class="fas fa-user-plus"></i></a></li>
            </ul>
        <?php else: ?>
            <!-- Signed In -->
            <ul>
                <p>Welcome, <?=$_SESSION['username'];?>!</p> |
                <li><a href="/myaccount">My Account <i class="fas fa-user"></i></a></li> |
                <?php if (isset($_SESSION['isOwner']) || isset($_SESSION['isAdmin'])): ?>
                    <li><a href="/admin">Admin Panel <i class="fas fa-cog"></i></a></li> |
                <?php endif; ?>
                <li><a href="/logout">Sign Out <i class="fas fa-sign-out-alt"></i></a></li>
            </ul>
        <?php endif; ?>
    </div>
</header>
