<?php 
include '../config/db.php';
include '../auth/auth.check.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $sender_id = $_SESSION['user_id'];
    $receiver_id = $_POST['receiver_id'];

    $check = $conn->prepare("select ID from friend_request where sender_id = ? AND receiver_id = ?");
    $check->bind_param("ii", $sender_id, $receiver_id);
    $check->execute();

    $exists = $check->get_result();

    if($exists->num_rows === 0){
        $stmt = $conn->prepare( "insert into friend_request (sender_id, receiver_id) values(?,?)");
        $stmt->bind_param("ii", $sender_id, $receiver_id);
        $stmt->execute();

         echo "
            <script>
                alert('Friend Request Sent Successfully!');
                window.location.href = '../pages/feed.php';
            </script>
        ";
        exit();

    }
    else{
        echo "
            <script>
                alert('Friend Request Already sent');
                window.location.href = '../pages/feed.php';
            </script>
        ";
        exit();
    }

}

?>