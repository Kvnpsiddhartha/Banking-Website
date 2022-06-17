<?php
session_start();
require("./baseup.php");
require("./navigation.php");
$url = "http://localhost/Banking%20Website/backend/history.php";

$postRequest = array(
    'id' => $_SESSION['userid'],
);

$cURLConnection = curl_init($url);
curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

$apiResponse = curl_exec($cURLConnection);
curl_close($cURLConnection);

// $apiResponse - available data from the API request
$response = json_decode($apiResponse, true);
if ($response['status']) {
    $data = $response['data'];
    echo '<div class="container"><h1>Transaction History</h1><br><table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Type</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Date</th>
      <th scope="col">Amount</th>
    </tr>
  </thead>
  <tbody>';

    foreach ($data as $d) {
        if ($d['amount'] > 0) {
            echo '<tr>
      <td>CREDIT FROM</td><td> ' . $d['cname'] . "</td><td>" . $d['date'] . " </td><td class='text-success'>+" . $d['amount'] . "</td></tr>";
        } else {
            echo
            '<tr>
      <td>DEBIT TO</td><td> ' . $d['cname'] . "</td><td>" . $d['date'] . " </td><td class='text-danger'>" . $d['amount'] . "</td></tr>";
        }
    }
    echo "</tbody>
</table></div>";
} else {
    echo "<h1>No Customers Found!</h1>";
}
