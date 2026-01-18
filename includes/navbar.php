<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?><style>
    *{
        box-sizing:border-box;
        font-family: 'Inter', sans-serif;
    }

    .navbar{
        background:#ffffff;
        padding:14px 30px;
        display:flex;
        align-items:center;
        gap:25px;
        box-shadow:0 8px 20px rgba(0,0,0,0.05);
        position:sticky;
        top:0;
        z-index:100;
    }

    .logo{
        font-size:20px;
        font-weight:600;
        color:#4f46e5;
        margin-right:10px;
    }

    .nav-links{
        display:flex;
        gap:18px;
    }

    .nav-links a{
        text-decoration:none;
        color:#374151;
        font-weight:500;
    }

    .nav-links a:hover{
        color:#4f46e5;
    }

    .search-box{
        flex:1;
        max-width:420px;
        display:flex;
        align-items:center;
        gap:8px;
        background:#f3f4f6;
        padding:8px 16px;
        border-radius:999px;
        margin-left:20px;
    }

    .search-box input{
        width:100%;
        border:none;
        background:transparent;
        outline:none;
        font-size:14px;
    }

    .search-box span{
        font-size:14px;
        color:#6b7280;
    }

    .nav-right{
        display:flex;
        align-items:center;
        gap:20px;
        margin-left:auto;
    }

    .username{
        font-weight:500;
        color:#374151;
    }

    .logout{
        background:#ef4444;
        color:#fff;
        padding:8px 16px;
        border-radius:8px;
        text-decoration:none;
        font-size:14px;
    }

    .logout:hover{
        background:#dc2626;
    }

    @media(max-width:768px){
        .search-box{
            max-width:260px;
        }
    }
</style>

<nav class="navbar">

    <!-- Logo -->
    <div class="logo">Social Core</div>

    <!-- Links -->
    <div class="nav-links">
        <a href="../pages/feed.php">Feed</a>
        <a href="../pages/profile.php">Profile</a>
        <a href="../pages/friends.php">Friends</a>
    </div>

    <!-- Search -->
    <form class="search-box" method="GET" action="../pages/result.php">
        <span>🔍</span>
        <input type="text" placeholder="Search" name="search">
    </form>

    <!-- Right -->
    <div class="nav-right">
        <span class="username">
            <?php echo $_SESSION['user_name']; ?>
        </span>
        <a class="logout" href="../auth/logout.php">Logout</a>
    </div>

</nav>
