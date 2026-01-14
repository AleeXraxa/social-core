<?php
include '../config/db.php';
include '../auth/auth.check.php';
include '../includes/navbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Social Core | Feed</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Inter', sans-serif;
        }

        body{
            background:#f3f4f6;
        }

        .container{
            display:grid;
            grid-template-columns:260px 1fr 300px;
            gap:20px;
            max-width:1400px;
            margin:0 auto;
            padding:20px;
        }

        /* Sidebar */
        .sidebar{
            background:#fff;
            border-radius:16px;
            padding:20px;
            height:fit-content;
        }

        .sidebar h3{
            margin-bottom:15px;
        }

        .sidebar ul{
            list-style:none;
        }

        .sidebar li{
            padding:10px 0;
            color:#374151;
            cursor:pointer;
        }

        /* Feed */
        .feed{
            display:flex;
            flex-direction:column;
            gap:20px;
        }

        /* Create Post */
        .create-post{
            background:#fff;
            padding:20px;
            border-radius:16px;
            box-shadow:0 10px 20px rgba(0,0,0,0.05);
        }

        .create-post textarea{
            width:100%;
            border:none;
            resize:none;
            font-size:15px;
            outline:none;
        }

        .create-post button{
            margin-top:10px;
            background:#4f46e5;
            color:#fff;
            border:none;
            padding:10px 18px;
            border-radius:10px;
            cursor:pointer;
        }

        /* Post Card */
        .post{
            background:#fff;
            padding:20px;
            border-radius:16px;
            box-shadow:0 10px 20px rgba(0,0,0,0.05);
            animation:fadeUp .4s ease;
        }

        @keyframes fadeUp{
            from{opacity:0; transform:translateY(20px);}
            to{opacity:1; transform:translateY(0);}
        }

        .post-header{
            display:flex;
            align-items:center;
            gap:10px;
            margin-bottom:10px;
        }

        .avatar{
            width:42px;
            height:42px;
            border-radius:50%;
            background:#6366f1;
            color:#fff;
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:600;
        }

        .post-header h4{
            font-size:14px;
        }

        .post-header span{
            font-size:12px;
            color:#6b7280;
        }

        .post p{
            margin:10px 0;
            color:#374151;
            line-height:1.5;
        }

        .post-actions{
            display:flex;
            gap:20px;
            margin-top:10px;
            font-size:14px;
            color:#4f46e5;
            cursor:pointer;
        }

        /* Right Panel */
        .right-panel{
            background:#fff;
            border-radius:16px;
            padding:20px;
            height:fit-content;
        }

        .right-panel h4{
            margin-bottom:10px;
        }

        .suggestion{
            padding:8px 0;
            font-size:14px;
            color:#374151;
        }

        @media(max-width:1100px){
            .container{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <!-- Sidebar -->
    <aside class="sidebar">
        <h3>Social Core</h3>
        <ul>
            <li>🏠 Feed</li>
            <li>👤 Profile</li>
            <li>💬 Messages</li>
            <li>🔔 Notifications</li>
            <li>⚙ Settings</li>
        </ul>
    </aside>

    <!-- Feed -->
    <main class="feed">

        <div class="create-post">
            <textarea rows="3" placeholder="What's on your mind?"></textarea>
            <button>Post</button>
        </div>

        <!-- Post -->
        <div class="post">
            <div class="post-header">
                <div class="avatar">A</div>
                <div>
                    <h4>Alee</h4>
                    <span>2 hours ago</span>
                </div>
            </div>
            <p>This is a sample post UI for Social Core feed. Clean, smooth and modern ✨</p>
            <div class="post-actions">
                <span>👍 Like</span>
                <span>💬 Comment</span>
                <span>↗ Share</span>
            </div>
        </div>

        <div class="post">
            <div class="post-header">
                <div class="avatar">S</div>
                <div>
                    <h4>Sarah</h4>
                    <span>Yesterday</span>
                </div>
            </div>
            <p>Loving how this Social Core UI is shaping up 🔥</p>
            <div class="post-actions">
                <span>👍 Like</span>
                <span>💬 Comment</span>
                <span>↗ Share</span>
            </div>
        </div>

    </main>

    <!-- Right Panel -->
    <aside class="right-panel">
        <h4>Suggestions</h4>
        <div class="suggestion">👤 John Doe</div>
        <div class="suggestion">👤 Ali Khan</div>
        <div class="suggestion">👤 Maria</div>
    </aside>

</div>

</body>
</html>
