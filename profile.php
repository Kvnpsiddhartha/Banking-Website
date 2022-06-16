<?php
session_start();
if (isset($_SESSION['userid'])) {
    require("./baseup.php");
    require("./navigation.php");
    $url = "http://localhost/Banking%20Website/backend/customerdetail.php";
    $postRequest = array("id" => $_SESSION['userid']);
    $cURLConnection = curl_init($url);
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    //for debug only!
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($cURLConnection);
    $resp = json_decode($resp, true);
    curl_close($cURLConnection);
    if ($resp['status']) {
        $data = $resp['data'];
?>
        <div class="container">
            <div class="card">
                <div class="card-header text-center">
                    Profile Details
                </div>
                <div class="card-body px-5">
                    <table style="margin:0px auto ;">
                        <tr>
                            <td class="px-5 py-2"><strong>Name: </strong></td>
                            <td class="px-5 py-2"><?php echo $data['name'] ?></td>
                        </tr>
                        <tr>
                            <td class="px-5 py-2"><strong>Email: </strong></td>
                            <td class="px-5 py-2"><?php echo $data['email'] ?></td>
                        </tr>
                        <tr>
                            <td class="px-5 py-2"><strong>Amount: </strong></td>
                            <td class="px-5 py-2"><?php echo $data['amount'] ?></td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
<?php
    }
}
?>