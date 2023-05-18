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
?>