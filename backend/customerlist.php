<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();
$response = $db->getCustomers();
if ($response['status']) {
    echo json_encode($response);
}
