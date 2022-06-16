<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();
if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['amount'])) {
    $response = $db->getRegister($_POST['name'], $_POST['email'], $_POST['password'], $_POST['amount']);
    echo json_encode($response);
}
