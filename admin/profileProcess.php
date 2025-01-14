<?php
include_once("include/dbh.admin.php");
$dbh = new dbHandler();

if (isset($_POST['getAdminInfo'])) {
    if (isset($_SESSION['admin_id'])) {
        echo json_encode((array)$dbh->getAllAdminInfo($_SESSION['admin_id']));
    } else {
        return false;
    }
}

if (isset($_POST['username'])) {
    $id = $_SESSION['admin_id'];
    $info = $dbh->getAllAdminInfo($id);
    $password = $_POST['password'];
    if ($password == $info->password) {
        if (isset($_POST['newPassword'])) {
            $newPassword = $_POST['newPassword'];
            if ($newPassword == $_POST['confirmPassword']) {
                $dbh->updateSpecificInfo($id, 'password', $newPassword);
            } else {
                echo json_encode(array(
                    "status" => 'error',
                    "msg" => 'Incorrect Password'
                ));
                exit();
            }
        }
        $dbh->updateSpecificInfo($id, 'username', $_POST['username']);
        $dbh->updateSpecificInfo($id, 'email', $_POST['email']);
        echo json_encode(array("status" => 'success'));
    } else {
        echo json_encode(array(
            "status" => 'error',
            "msg" => 'Incorrect Password'
        ));
    }
}
