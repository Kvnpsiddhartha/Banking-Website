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
    echo "<h1>Customers</h1><br><ul>";

    foreach ($data as $d) {
        echo "<li>" . $d['name'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<h1>No Customers Found!</h1>";
}
