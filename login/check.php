<?php
require_once '../../config/config.php';
require_once '../../system/Database.php';
$db = Database::Instance();
if (!empty($_POST)) {

    if (isset($_POST['username']) && !empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $userName = $_POST['username'];
        $adminResult = $db->Select("SELECT * FROM tbl_admins 
                                      WHERE username='$userName'");
        if (count($adminResult) > 0) {
            echo '<i class="fa fa-check" aria-hidden="true"></i>';
        } else {
            echo "<a href='' style='color: red;'>Username not found</a>";
        }
    }

    if (isset($_POST['password']) && !empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $password = md5($_POST['password']);
        $adminResult = $db->Select("SELECT * FROM tbl_admins 
                                      WHERE password='$password'");
        if (count($adminResult) > 0) {
            echo '<i class="fa fa-check" aria-hidden="true"></i>';
        } else {
            echo "<a href='' style='color: red;'>password not match</a>";
        }
    }


    if (isset($_POST['admin_login']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $adminResult = $db->Select("SELECT * FROM tbl_admins WHERE username='$username' && password='$password'");
        if (count($adminResult) > 0) {
            $adminData = array_shift($adminResult);
            $_SESSION['admin_id'] = $adminData->id;
            $_SESSION['username'] = $adminData->username;
            $_SESSION['email'] = $adminData->email;
            $_SESSION['image'] = $adminData->image;
            $_SESSION['is_login'] = true;
            $_SESSION['privilege'] = 'admin';

            redirect_to('admin');


        } else {

            $_SESSION['error'] = "username and password not match";
            redirect_to('admin/login');
        }


    }
}
else{
    redirect_to('admin/login');
}

?>