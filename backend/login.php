<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();
if (isset($_POST['email'], $_POST['password'])) {
    $response = $db->getLogin($_POST['email'], $_POST['password']);
    echo json_encode($response);
}
