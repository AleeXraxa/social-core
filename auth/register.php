<?php
include("../config/db.php");

$error = '';
$success = '';


if($_SERVER['REQUEST_METHOD']== 'POST'){
    $name = $_POST['name'];
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);

    $stmt = $conn->prepare("select * from users where email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows()>0){
        $error = 'Email Already Exits';
    }
    else{
        $hashedpass = password_hash($pass, PASSWORD_DEFAULT);

        $insert = $conn->prepare("insert into users (name,email,password) values(?,?,?)");
        $insert-> bind_param("sss", $name,$email,$hashedpass);

        if($insert->execute()){
            $success = "Registration Successful";
        }
        else{
            $error = "Registration Failed";
        }

    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register - Social Core</title>
<style>
    /* General Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        height: 100vh;
        background: linear-gradient(to right, #6a11cb, #2575fc);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .register-container {
        background: #fff;
        padding: 40px 30px;
        border-radius: 15px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.2);
    }

    .register-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #555;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        border-color: #2575fc;
        box-shadow: 0 0 5px rgba(37,117,252,0.5);
        outline: none;
    }

    .btn-submit {
        width: 100%;
        padding: 12px;
        border: none;
        background: #2575fc;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .btn-submit:hover {
        background: #6a11cb;
    }

    .text-center {
        text-align: center;
        margin-top: 15px;
        color: #555;
    }

    .text-center a {
        color: #2575fc;
        text-decoration: none;
        font-weight: 600;
    }

    .text-center a:hover {
        text-decoration: underline;
    }

    @media (max-width: 450px) {
        .register-container {
            padding: 30px 20px;
        }
    }
</style>
</head>
<body>

<div class="register-container">
    <h2>Create Account</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="John Doe" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="example@mail.com" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" class="btn-submit">Register</button>
    </form>

    
    <?php if(isset($error))echo "<p style='text-align:center; color:red'>$error </p>"?>
    <?php if(isset($success))echo "<p style='text-align:center; color:green'>$success </p>"?>
    <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
</div>

</body>
</html>
