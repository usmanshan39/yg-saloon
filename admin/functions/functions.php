<?php 
    // Start the session
    session_start();

    if(!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }
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
    else if($action == "addAppointment"){
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
        $id = $_POST['id'];
        $sql = "SELECT * FROM appointments where id = ".$id."";
        $result = $conn->query($sql);
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $name = $row['name'];
                    $email = $row['email'];
                    $phone = $row['mobile'];

                    $to = $email;
                    $subject = 'Yg Saloon Appointment Reminder';
                    $headers = "From: info@ygsalon.ae\r\n";
                    $headers .= "Reply-To: info@ygsalon.ae\r\n";
                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                    $body = "<h2>Hi ".$name."</h2>";
                    $body .= "<p>Your appointment for yg saloon is on data ".$row['app_date']." at time ".$row['app_time']."</p>";
                    $body .= "<p>Please Insure your availablity</p>";
                    $body .= "<p>Thanks</p>";


                    // Send the email
                    if (mail($to, $subject, $body, $headers)) {
                    echo "Thank you for your booking request! We will get back to you shortly.";
                    } else {
                    echo "There was an error sending your booking request. Please try again.";
                    }
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


    // ******************* Blogs Sections *******************

    else if($action == "fetchAllBlogs"){
        $sql = "SELECT * FROM our_blogs";
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
    else if($action == "addNewBlog"){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $published = $_POST['blogStatus'];
        $metaTitle = $_POST['metaTitle'];
        $metaDesc = $_POST['metaDesc'];
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

        // echo 'metaTitle '.$metaTitle.'<br>';
        // echo 'metaDesc '.$metaDesc.'<br>';
        // echo 'targetFile '.$targetFile.'<br>';


        // die();

        $sql = "INSERT INTO our_blogs (title, blog_image, blog_desc, published , meta_title , meta_desc) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ssssss", $title, $targetFile, $description, $published , $metaTitle , $metaDesc);

        if ($stmt->execute()) {
            $data = array("status" => true, "message" => "Blog Created Successfully");
            echo json_encode($data);
        } else {
            $data = array("status" => false, "data" => "Failed To Create Blog");
            echo json_encode($data);
        }

    }

    else if($action == "getSingleBlog"){
        $id = $_POST['id'];
        $sql = "SELECT * FROM our_blogs where id = ".$id."";
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

    else if($action == "updateBlog"){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $published = $_POST['editBlogStatus'];
        $description = $_POST['description'];
        $metaTitle = $_POST['metaTitle'];
        $metaDesc = $_POST['metaDesc'];

        $sql = "UPDATE our_blogs SET title = ?, blog_desc = ?, published = ? , meta_title = ?, meta_desc = ? WHERE id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssssi", $title, $description, $published, $metaTitle, $metaDesc,  $id);
        if ($stmt->execute()) {
            $data = array("status" => true, "message" => "Successfully Update Appointment");
            echo json_encode($data);
        } else {
            $data = array("status" => false, "data" => "Failed To Updated Appointment");
            echo json_encode($data);
        }
    }

    else if ($action == "deleteBlog"){
        $id  = $_POST['id'];
        $sql = "DELETE FROM our_blogs WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $data = array("status" => true, "message" => "Blog Deleted Successfully");
            echo json_encode($data);
        }else{
            $data = array("status" => false, "message" => "Failed To Delete Blog");
            echo json_encode($data);
        }
    }

    // ******************* Users Sections *******************

    else if($action == "addUser"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $type = $_POST['userType'];

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $checkSql = "SELECT COUNT(*) AS count FROM users WHERE user_email = ?";
        $checkStmt = $conn->prepare($checkSql);
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $result = $checkStmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            $data = array("status" => false, "message" => "User already exists with the same email");
            echo json_encode($data);
        } else {
            $sql = "INSERT INTO users (user_name, user_email, user_password, user_type) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $name, $email, $hashedPassword, $type);

            if ($stmt->execute()) {
                $data = array("status" => true, "message" => "User Created Successfully");
                echo json_encode($data);
            } else {
                $data = array("status" => false, "message" => "Failed To Create User");
                echo json_encode($data);
            }
        }
    }

    else if($action == "fetchAllUsers"){
        $sql = "SELECT * FROM users";
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

    else if($action == "getSingleUser"){
        $id = $_POST['id'];
        $sql = "SELECT * FROM users where id = ".$id."";
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
    
    else if($action == "updateUser"){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $type = $_POST['userType'];


        $singleUser = "SELECT * FROM users where id = ".$id."";
        $singleUserResult = $conn->query($singleUser);
        if ($singleUserResult) {
            if ($singleUserResult->num_rows > 0) {
                while ($row = $singleUserResult->fetch_assoc()) {
                    if($row['user_email'] == $email){
                        $sql = "UPDATE users SET user_name = ?, user_email = ?, user_type = ? WHERE id = ?";
                        $stmt = $conn->prepare($sql);

                        $stmt->bind_param("sssi", $name, $email, $type, $id);
                        if ($stmt->execute()) {
                            $data = array("status" => true, "message" => "Successfully Update Appointment");
                            echo json_encode($data);
                        } else {
                            $data = array("status" => false, "data" => "Failed To Updated Appointment");
                            echo json_encode($data);
                        }
                    }
                    else{
                        $checkSql = "SELECT COUNT(*) AS count FROM users WHERE user_email = ?";
                        $checkStmt = $conn->prepare($checkSql);
                        $checkStmt->bind_param("s", $email);
                        $checkStmt->execute();
                        $result = $checkStmt->get_result();
                        $row = $result->fetch_assoc();

                        if ($row['count'] > 0) {
                            $data = array("status" => false, "message" => "User already exists with the same email");
                            echo json_encode($data);
                        } else {
                            $sql = "UPDATE users SET user_name = ?, user_email = ?, user_type = ? WHERE id = ?";

                            $stmt = $conn->prepare($sql);

                            $stmt->bind_param("sssi", $name, $email, $type, $id);
                            if ($stmt->execute()) {
                                $data = array("status" => true, "message" => "Successfully Update Appointment");
                                echo json_encode($data);
                            } else {
                                $data = array("status" => false, "data" => "Failed To Updated Appointment");
                                echo json_encode($data);
                            }
                        }
                    }
                    
                }
            }
        }

    }

    else if ($action == "deleteUser"){
        $id  = $_POST['id'];
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $data = array("status" => true, "message" => "User Deleted Successfully");
            echo json_encode($data);
        }else{
            $data = array("status" => false, "message" => "Failed To Delete User");
            echo json_encode($data);
        }
    }

?>