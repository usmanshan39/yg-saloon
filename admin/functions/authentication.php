<?php 

require_once("config.php");
$action = $_POST['action'];

if($action == "login"){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if ($user) {
        if (password_verify($password, $user['user_password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['user_name'];
            $_SESSION['userType'] = $user['user_type'];
            $data = array("status" => true);
            echo json_encode($data);
        } else {
            $data = array("status" => false, "message" => "Invalid email or password!");
            echo json_encode($data);
        }
    } else {
        $data = array("status" => false, "message" => "Invalid email or password!");
        echo json_encode($data);
    }
}

?>