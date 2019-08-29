<?php

$db = Database::Instance();

if (!empty($_GET['criteria'])) {
    $criteria = $_GET['criteria'];
    $result = $db->Delete('tbl_contacts', 'id=?', array($criteria));
    if ($result == true) {
        $_SESSION['success'] = 'message was successfully remove';
        redirect_to('admin/contacts');
    }

}



