<?php
include 'DBHANDLER.php';
$db = new DBHANDLER();
if (isset($_POST['from'], $_POST['to'], $_POST['amount'])) {
    $response = $db->transact($_POST['from'], $_POST['to'], $_POST['amount']);
    echo json_encode($response);
}
