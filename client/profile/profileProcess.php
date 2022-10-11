<?php
include_once('../include/dbh.inc.php');
$dbh = new dbHandler;

//Profile Edit Info
$img_path = "";

// var_dump($_FILES);
if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
    
    $img_path = "image/" . basename($_FILES['image']['name']);

    move_uploaded_file($_FILES['image']['tmp_name'], $img_path);


} else {

    // echo "naka set";
    $img_path = $_POST["file_path"];
    // echo $img_path;
}

if (isset($_POST['firstName'])) {

    $info = (object) [
        'firstName' => $_POST['firstName'],
        'middleName' => $_POST['middleName'],
        'lastName' => $_POST['lastName'],
        //'username' => $_POST['username'],
        'email' => $_POST['email'],
        'contact_no' => $_POST['contact_no'],
        'house_no' => $_POST['house_no'],
        'street' => $_POST['street'],
        'barangay' => $_POST['barangay'],
        'municipality' => $_POST['municipality'],
        'province' => $_POST['province'],
        'image' => $img_path
    ];


    if ($dbh->profileUpdate($info, $_SESSION['id'])) {
        // echo $img_path;
        // move_uploaded_file($_FILES['image']['tmp_name'], $img_path);
        echo json_encode(array(
            "status" => 'success',
            "msg" => 'Profile Update Successfully.'
        ));
    }
}
