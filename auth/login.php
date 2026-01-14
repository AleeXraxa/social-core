<?php
session_start();
include '../config/db.php';

$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("select ID, name, password from users where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows===1){

        $user=$result->fetch_assoc();

        if(password_verify($pass, $user['password'])){
            $_SESSION['user_id']= $user['ID'];
            $_SESSION['user_name']= $user['name'];

            $success = 'Login Success';
            header("Location: ../pages/profile.php");
            exit();
        }else{
            $error = "Invalid Password";
        }

    }
    else{
        $error = 'User not found';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Social Core</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        height: 100vh;
        background: linear-gradient(to right, #141e30, #243b55);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-container {
        background: #fff;
        width: 100%;
        max-width: 400px;
        padding: 40px 30px;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    }

    .login-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #222;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
        color: #555;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
        transition: 0.3s ease;
    }

    .form-group input:focus {
        border-color: #243b55;
        box-shadow: 0 0 6px rgba(36,59,85,0.4);
        outline: none;
    }

    .btn-login {
        width: 100%;
        padding: 12px;
        background: #243b55;
        border: none;
        border-radius: 10px;
        color: #fff;
        font-size: 17px;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-login:hover {
        background: #141e30;
    }

    .extra-links {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        font-size: 14px;
    }

    .extra-links a {
        text-decoration: none;
        color: #243b55;
        font-weight: 600;
    }

    .extra-links a:hover {
        text-decoration: underline;
    }

    .register-link {
        text-align: center;
        margin-top: 20px;
        color: #555;
    }

    .register-link a {
        color: #243b55;
        font-weight: 600;
        text-decoration: none;
    }

    .register-link a:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>

<div class="login-container">
    <h2>Welcome Back</h2>

    <form method="POST" action="">
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="example@mail.com" required>
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn-login">Login</button>
    </form>
      <?php if(isset($error))echo "<p style='text-align:center; color:red'>$error </p>"?> 

    <div class="extra-links">
        <a href="#">Forgot Password?</a>
    </div>

    <div class="register-link">
        Don’t have an account?
        <a href="register.php">Create one</a>
    </div>
</div>

</body>
</html>
