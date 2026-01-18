<?php
include '../config/db.php';
include '../auth/auth.check.php';
include '../includes/navbar.php';

if(isset($_GET['search']) && !empty(trim($_GET['search']))){
    
    $user_id = $_SESSION['user_id'];
    $search = $_GET['search'];
    $like = "%".$search."%";

    $stmt = $conn->prepare("select ID, name from users where name like ? AND ID != ?");
    $stmt->bind_param("si", $like,$user_id);
    $stmt->execute();
    $result = $stmt->get_result();

   
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results | Social Core</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body{
            margin:0;
            background:#f3f4f6;
            font-family:'Inter', sans-serif;
        }

        .container{
            max-width:700px;
            margin:30px auto;
            padding:0 15px;
        }

        .page-title{
            font-size:22px;
            font-weight:600;
            margin-bottom:20px;
            color:#111827;
        }

        .result-card{
            background:#ffffff;
            border-radius:14px;
            padding:18px 20px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            box-shadow:0 8px 20px rgba(0,0,0,0.05);
            margin-bottom:16px;
            animation:fadeUp .4s ease;
        }

        @keyframes fadeUp{
            from{opacity:0; transform:translateY(20px);}
            to{opacity:1; transform:translateY(0);}
        }

        .user-info{
            display:flex;
            flex-direction:column;
            gap:4px;
        }

        .user-name{
            font-size:16px;
            font-weight:600;
            color:#111827;
        }

        .user-email{
            font-size:13px;
            color:#6b7280;
        }

        .action-btn{
            background:#4f46e5;
            color:#fff;
            border:none;
            padding:8px 16px;
            border-radius:10px;
            font-size:14px;
            cursor:pointer;
        }

        .action-btn:hover{
            background:#4338ca;
        }

        .no-result{
            text-align:center;
            margin-top:80px;
            color:#6b7280;
            font-size:15px;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="page-title">
            Search Results
        </div>

        <?php 
            if($result && $result->num_rows>0){
                while($user = $result->fetch_assoc()){
                    echo "

                      <div class='result-card'>
                      <div class='user-info'>
                         <span class='user-name'>{$user['name']}</span>
                     </div>
                         <form method='POST' action='../actions/send_request.php'>
                        <input type='hidden' name='receiver_id' value='{$user['ID']}'>
                        <button style='
                            background:#4f46e5;
                            color:#fff;
                            border:none;
                            padding:8px 14px;
                            border-radius:8px;
                            cursor:pointer;
                        '>
                            Send Request
                        </button>
                    </form>
                    </div>
                    ";
                }
            }
            else{
                echo "User not found";
            }
        ?>
        
       

     
      

    </div>

</body>
</html>
