<?php 
    require_once("config.php");
    $action = $_POST['action'];

    // ******************* Fetch All Appointments *******************
    if($action == "fetchAllAppointments"){
        $sql = "SELECT * FROM appointments";
        $result = $conn->query($sql);
        $data = array();
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
        }
    echo json_encode($data);
    }

    else if($action == "getSingleAppointment"){
        $id = $_POST['id'];
        $sql = "SELECT * FROM appointments where id = ".$id."";
        $result = $conn->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data = array("status"=> true , "data"=>$row);
                    echo json_encode($data);
                }
            }else{
                $data = array("status"=> false , "data"=>"");
                echo json_encode($data);
            }
        }else{
            $data = array("status"=> false , "data"=>"");
            echo json_encode($data);
        }
    }

    else if($action == "updateAppointment"){
        $id = $_POST['id'];
        $time = $_POST['time'];
        $date = $_POST['date'];
        $sql = "UPDATE appointments SET app_date = '$date' , app_time = '$time' WHERE id = '$id'";
        $result = mysqli_query($conn , $sql);
        if($result){
            $data = array("status"=> true , "message"=>"Successfully Update Appointment");
            echo json_encode($data);
        }else{
            $data = array("status"=> false , "data"=>"Failed To Updated Appointment");
            echo json_encode($data);
        }
    }
    
    else if($action == "markAppComplete"){
        $id = $_POST['id'];
        $sql = "UPDATE appointments SET status = 'Complete' WHERE id = '$id'";
        $result = mysqli_query($conn , $sql);
        if($result){
            $data = array("status"=> true , "message"=>"Successfully Completed Appointment");
            echo json_encode($data);
        }else{
            $data = array("status"=> false , "data"=>"Failed To Completed Appointment");
            echo json_encode($data);
        }
    }

    else if($action == "markAppCancel"){
        $id = $_POST['id'];
        $sql = "UPDATE appointments SET status = 'Cancel' WHERE id = '$id'";
        $result = mysqli_query($conn , $sql);
        if($result){
            $data = array("status"=> true , "message"=>"Appointment Cancel Successfully");
            echo json_encode($data);
        }else{
            $data = array("status"=> false , "data"=>"Failed To Cancel the Appountment");
            echo json_encode($data);
        }
    }

    else if($action == "sendEmail"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];

        $to = 'booking@creation31.com';
        $subject = 'New booking request';
        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $body = "<h2>New booking request</h2>";
        $body .= "<p><strong>Name:</strong> $name</p>";
        $body .= "<p><strong>Email:</strong> $email</p>";
        $body .= "<p><strong>Phone:</strong> $phone</p>";
        $body .= "<p><strong>Message:</strong> $message</p>";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
        echo "Thank you for your booking request! We will get back to you shortly.";
        } else {
        echo "There was an error sending your booking request. Please try again.";
        }
    }

?>