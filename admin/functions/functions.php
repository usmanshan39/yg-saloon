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

?>