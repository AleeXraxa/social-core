<?php
include '../config/db.php';
include '../auth/auth.check.php';
include '../includes/navbar.php';

    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("select * from users where ID=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt-> get_result();

    if($result->num_rows===1){
        $user = $result->fetch_assoc();
        $name = $user['name'];
        $email = $user['email'];
        $joined = date("M Y", strtotime($user['created_at']));

    }
    else{
        $name = "Unknown";
        $email = "unknown@domain.com";
        $joined = "unknown";
    }


    // Create Posts
    if(isset($_POST['create_post'])){
        $content = $_POST['content'];

        if(!empty($content)){
            $stmt = $conn->prepare("insert into posts(user_id, content) values(?,?)");
            $stmt->bind_param("is", $user_id, $content);
            if($stmt->execute()){
                header("location: profile.php");
                exit();
            }
            else{
                 $post_error = "Failed to create post. Try again!";
            }
        }
        else{
            $post_error = "Post content cannot be empty!";
        }
    }



    // Fetch Posts
    $post_stmt =$conn->prepare( "select * from posts where user_id = ? order by created_at desc");
    $post_stmt-> bind_param("i", $user_id);
    $post_stmt->execute();

    $post_result = $post_stmt->get_result();


    

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Social Core | Profile</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
*{
    box-sizing:border-box;
}
body{
    margin:0;
    font-family:'Inter', sans-serif;
    background:#f4f6fb;
}

/* ====== HEADER / COVER ====== */
.cover{
    height:280px;
    background:linear-gradient(135deg,#4f46e5,#3b82f6);
    position:relative;
}

.profile-pic{
    width:170px;
    height:170px;
    background:#fff;
    border-radius:50%;
    position:absolute;
    bottom:-85px;
    left:60px;
    padding:6px;
    animation: pop 0.8s ease;
}

.profile-pic img{
    width:100%;
    height:100%;
    border-radius:50%;
    object-fit:cover;
}

@keyframes pop{
    0%{transform:scale(0.7);opacity:0}
    100%{transform:scale(1);opacity:1}
}

/* ====== MAIN CONTAINER ====== */
.container{
    width:1100px;
    margin:120px auto 40px;
}

/* ====== TOP INFO ====== */
.top-info{
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:#fff;
    padding:25px 30px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    animation: fadeUp .6s ease;
}

@keyframes fadeUp{
    from{transform:translateY(20px);opacity:0}
    to{transform:translateY(0);opacity:1}
}

.name{
    font-size:26px;
    font-weight:700;
}

.email{
    color:#6b7280;
    margin-top:5px;
}

.stats{
    display:flex;
    gap:25px;
    margin-top:15px;
}

.stat{
    text-align:center;
}

.stat h3{
    margin:0;
    font-size:20px;
}

.stat span{
    color:#6b7280;
    font-size:14px;
}

.btn{
    background:#4f46e5;
    color:#fff;
    padding:12px 22px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
    transition:.3s;
}

.btn:hover{
    background:#4338ca;
}

/* ====== GRID ====== */
.grid{
    display:grid;
    grid-template-columns: 350px 1fr;
    gap:25px;
    margin-top:25px;
}

/* ====== LEFT CARD ====== */
.card{
    background:#fff;
    padding:25px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
}

.card h4{
    margin:0 0 15px;
}

/* ====== POSTS ====== */
.post{
    background:#fff;
    padding:20px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
    margin-bottom:20px;
    animation: fadeUp .5s ease;
}

.post-header{
    font-weight:600;
    margin-bottom:10px;
}

.post-time{
    font-size:13px;
    color:#6b7280;
}

.post-actions{
    margin-top:15px;
    display:flex;
    gap:20px;
    font-size:14px;
    color:#4f46e5;
    cursor:pointer;
}

</style>
</head>

<body>

<!-- COVER -->
<div class="cover">
    <div class="profile-pic">
        <img src="https://via.placeholder.com/300">
    </div>
</div>

<div class="container">

    <!-- TOP INFO -->
    <div class="top-info">
        <div>
            <div class="name"><?php echo $name?></div>
            <div class="email"><?php echo $email?></div>

            <div class="stats">
                <div class="stat">
                    <h3>24</h3>
                    <span>Posts</span>
                </div>
                <div class="stat">
                    <h3>1.2K</h3>
                    <span>Followers</span>
                </div>
                <div class="stat">
                    <h3>180</h3>
                    <span>Following</span>
                </div>
            </div>
        </div>

        <button class="btn">Edit Profile</button>
    </div>

    <!-- GRID -->
    <div class="grid">

        <!-- LEFT -->
        <div class="card">
            <h4>About</h4>
            <p>
                🚀 PHP Developer <br>
                💻 Building Social Core <br>
                🎯 Learning Full-Stack Step by Step
            </p>

            <hr>

            <p><b>Joined:</b> <?php echo $joined?></p>
        </div>



        <!-- RIGHT -->
        <div>
            
        <!-- add new post -->
        <div class="card" style="margin-bottom:20px; box-shadow:0 10px 20px rgba(0,0,0,0.05);">
    <form method="POST" action="">
        <textarea 
            name="content" 
            rows="3" 
            placeholder="What's on your mind?" 
            style="width:100%; padding:15px; border-radius:12px; border:1px solid #ccc; font-size:15px; resize:none;"
            required
        ></textarea>
        <br><br>
        <button type="submit" name="create_post" class="btn" style="width:100%; padding:12px; font-size:16px; border-radius:12px;">
            Post
        </button>
    </form>

    <?php if(isset($post_error)){ ?>
        <p style="color:red; margin-top:10px;"><?php echo $post_error; ?></p>
    <?php } ?>
</div>

          <?php
            if($post_result->num_rows>0){
                while($post = $post_result->fetch_assoc()){
                    echo "
                                  
            <div class='post'>
                <div class='post-header'>$name</div>
                <div class='post-time'>{$post['created_at']}</div>
                <p>{$post['content']}</p>

                <div class='post-actions'>
                    <span>👍 Like</span>
                    <span>💬 Comment</span>
                </div>
            </div>
                    
                    
                    ";
                }
            }
          
          
          ?>

        </div>

    </div>

</div>

</body>
</html>
