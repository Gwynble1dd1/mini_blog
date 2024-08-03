<?php
session_start();
require "SessionObject.php";
// Read the request payload from the input stream
$requestPayload = file_get_contents('php://input');

// Parse the JSON payload into a PHP associative array
$data = json_decode($requestPayload, true);
header('content-type:application/json');
$sessionObj = new SessionObject();
$action = isset($_POST['action']) ? $_POST['action'] : $data['action'];




switch($action){
    
    case "login":
        $result = $sessionObj->login($data['username'],$data['password']);
        if($result['status']){
            echo json_encode(["status"=> $result['status'], "data"=>"login success!"]);
            $_SESSION['username'] = $result['data'][0]['username'];
            $_SESSION['userId'] = $result['data'][0]['user_id'];
            $_SESSION['userDesc'] = $result['data'][0]['user_description'];
            $_SESSION['profileImg'] = $result['data'][0]['profile_image'];
            exit(0);
        }
        else{
            echo json_encode(["status"=> $result['status'], "data"=>"login faild!"]);
        }
        break;

    case "register":
        $result = $sessionObj->register($data['username'],$data['password']);
        if($result['status']){
            echo json_encode(["status"=> $result['status'], "data"=>"register success!"]);
            exit(0);
        }
        else{
            echo json_encode(["status"=> $result['status'], "data"=>"register faild!"]);
        }
        break;

    case "updateUsername":
        if(!isset($data['username'])) {
            echo json_encode(["status"=> $result['status'], "data"=>"not all information sent"]);
            exit(0);
        }
        $result = $sessionObj->updateUsername($_SESSION['userId'], $data['username']);
        if($result['status']){
            echo json_encode(["status"=> $result['status'], "data"=>$result['data']]);
            exit(0);
        }
        else{
            echo json_encode(["status"=> $result['status'], "data"=>$result['data']]);
        }
        break;

    case "updatePassword":
        if(!isset($data['password'])) {
            echo json_encode(["status"=> $result['status'], "data"=>"not all information sent"]);
            exit(0);
        }
        $result = $sessionObj->updatePassword($_SESSION['userId'], $data['password']);
        if($result['status']){
            echo json_encode(["status"=> $result['status'], "data"=>$result['data']]);
            exit(0);
        }
        else{
            echo json_encode(["status"=> $result['status'], "data"=>$result['data']]);
        }
        break;

    case "updateDescription":
        if(!isset($data['userDesc'])) {
            echo json_encode(["status"=> $result['status'], "data"=>"not all information sent"]);
            exit(0);
        }
        $result = $sessionObj->updateDescription($_SESSION['userId'], $data['userDesc']);
        if($result['status']){
            echo json_encode(["status"=> $result['status'], "data"=>$result['data']]);
            exit(0);
        }
        else{
            echo json_encode(["status"=> $result['status'], "data"=>$result['data']]);
        }
        break;

    case "Upload":
        if(!isset($_FILES['image'])){
            echo json_encode(["status"=> false, "data"=>"no image sent"]);
            exit(0);
        }

        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_name_parts = explode('.', $_FILES['image']['name']);
        $file_ext = strtolower(end($file_name_parts));
        $extensions = array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions) === false){
            echo json_encode(["status"=> false, "data"=>"extension not allowed, please choose a JPEG or PNG file."]);
            exit(0);
        }

        if($file_size > 5242880){
            echo json_encode(["status"=> false, "data"=>"File size must be less than 5 MB"]);
            exit(0);
        }

    
        $upload_dir = "uploads/";
        $upload_file = $upload_dir . basename($file_name);
        
        // Check if file already exists on the server
        if (file_exists($upload_file)) {
            echo json_encode(["status"=>false, "data"=>"File already exists"]);
            exit(0);
        }
        // Check file size - maximum 5MB
        if ($_FILES["image"]["size"] > 5000000) {
            echo json_encode(["status"=>false, "data"=>"File size too large. Maximum file size is 5MB"]);
            exit(0);
        }
        // Allow only certain file types
        $allowed_types = array("jpg", "jpeg", "png");
        $file_type = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
        if (!in_array($file_type, $allowed_types)) {
            echo json_encode(["status"=>false, "data"=>"Only JPG, JPEG, and PNG files are allowed"]);
            exit(0);
        }
        // Attempt to upload file to server
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $upload_file)) {
            echo json_encode(["status"=>false, "data"=>"Error uploading file"]);
            exit(0);
        }
        // Update user profile image in database
        $result = $sessionObj->updateProfileImage($_SESSION['userId'], $upload_file);
        if ($result['status']) {
            $_SESSION['profileImg'] = $upload_file;
            echo json_encode(["status"=>true, "data"=>"File uploaded successfully","img"=>$upload_file]);
        } else {
            // Delete the uploaded file from server if database update failed
            unlink($upload_file);
            echo json_encode(["status"=>false, "data"=>"Error updating profile image in database"]);
        }
        break;
        
    case "addPost":
        if(!isset($_FILES['file'])){
            echo json_encode(["status"=> false, 'data'=> 'no image']); // "data"=>$_FILES['file-upload']['name'],                exit(0);
            exit(0);
        }

        $file_name = $_FILES['file']['name'];
        $file_size = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_type = $_FILES['file']['type'];
        $file_name_parts = explode('.', $_FILES['file']['name']);
        $file_ext = strtolower(end($file_name_parts));
        $extensions = array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions) === false){
            echo json_encode(["status"=> false, "data"=>"extension not allowed, please choose a JPEG or PNG file."]);
            exit(0);
        }

        if($file_size > 5242880){
            echo json_encode(["status"=> false, "data"=>"File size must be less than 5 MB"]);
            exit(0);
        }

        $file_name = mt_rand(0,123123123). $file_name;
        $upload_dir = "uploads/";
        $upload_file = $upload_dir . basename($file_name);
        
        // Check if file already exists on the server
        if (file_exists($upload_file)) {
            echo json_encode(["status"=>false, "data"=>"File already exists"]);
            exit(0);
        }
        // Check file size - maximum 5MB
        if ($_FILES["file"]["size"] > 5000000) {
            echo json_encode(["status"=>false, "data"=>"File size too large. Maximum file size is 5MB"]);
            exit(0);
        }
        // Allow only certain file types
        $allowed_types = array("jpg", "jpeg", "png");
        $file_type = strtolower(pathinfo($upload_file, PATHINFO_EXTENSION));
        if (!in_array($file_type, $allowed_types)) {
            echo json_encode(["status"=>false, "data"=>"Only JPG, JPEG, and PNG files are allowed"]);
            exit(0);
        }

        // Attempt to upload file to server
        if (!move_uploaded_file($_FILES["file"]["tmp_name"], $upload_file)) {
            echo json_encode(["status"=>false, "data"=>"Error uploading file"]);
            exit(0);
        }
        // Update user profile image in database
        $result = $sessionObj->addPost($_POST['post_name'], $_SESSION['username'], $_POST['post_content'], $upload_file);
        if ($result['status']) {
            echo json_encode(["status"=>true, "data"=>"Post maded successfully","img"=>$upload_file]);
        } else {
            // Delete the uploaded file from server if database update failed
            unlink($upload_file);
            echo json_encode(["status"=>false, "data"=>"Error adding post in database", "test"=>print_r($result)]);
        }
        break;

        default:
            echo json_encode(["status"=>false, "data"=>$data]);

}


?>