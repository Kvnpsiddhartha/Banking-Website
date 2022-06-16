<?php
session_start();
require("./baseup.php");
require("./navigation.php");
$url = "http://localhost/Banking%20Website/backend/customerlist.php";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

//for debug only!
// curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
// curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
$resp = json_decode($resp, true);
curl_close($curl);
if ($resp['status']) {
    $data = $resp['data'];
    echo '<div class="container"><h1>Select a Customer </h1><br><form method="POST" action="./transact.php" class="form-group">';

    foreach ($data as $d) {
        if (!($d['id'] == $_SESSION['userid'])) {
            echo '<div class="form-check"><input type="radio" name="customer_id" class="form-check-input" value="' . $d['id'] . '" id="' . $d['name'] . '"><label class="form-check-label" for="' . $d['name'] . '">' . $d['name'] . '</label></div>';
        }
    }
    echo '</br><input type="submit" class="btn btn-primary" value="next" name="clist"/>';
    echo "</form></div>";
} else {
    echo "<h1>No Customers Found!</h1>";
}
