<?php 

require_once("./config.php");
$action = $_POST['action'];

if($action == "addAppointment"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $sql = "INSERT INTO appointments (name  , email , mobile , app_date , app_time)VALUE('$name' , '$email' , '$mobile' , '$date' , '$time')";
    $result = mysqli_query($conn , $sql);
    if($result){
        $data = array("status"=> true , "message"=>"Successfully Create Appointment");
        echo json_encode($data);
    }else{
        $data = array("status"=> false , "data"=>"Failed To Created Appointment");
        echo json_encode($data);
    }
}else if($action == "addEmailSubscriber"){
    $email = $_POST['email'];
    $sql = "INSERT INTO email_subscriber (email)VALUE('$email')";
    $result = mysqli_query($conn , $sql);
    if($result){
        $data = array("status"=> true , "message"=>"Thanks for Subscribe Our Newsletter");
        echo json_encode($data);
    }else{
        $data = array("status"=> false , "data"=>"Failed To Subscribe");
        echo json_encode($data);
    }
}



?>