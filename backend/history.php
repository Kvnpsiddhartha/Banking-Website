<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();
if (isset($_POST['id'])) {
    $response = $db->getHistory($_POST['id']);
    echo json_encode($response);
}
