<?php
session_start();
if (isset($_SESSION['userid'])) {
    require("./baseup.php");
    require("./navigation.php");
    if (isset($_POST['submit'], $_POST['amount'])) {
        $url = "http://localhost/Banking%20Website/backend/transact.php";
        $postRequest = array("from" => $_SESSION['from'], "to" => $_SESSION['to'], "amount" => $_POST['amount']);
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
            echo '<h1 class="text-center"> Transaction Successful</h1>';
        } else {
            echo '<h1 class="text-center"> Transaction Unsuccessful</h1>';
        }
        unset($_POST['amount']);
    }
    $url = "http://localhost/Banking%20Website/backend/customerdetail.php";
    $postRequest = array("id" => $_SESSION['userid']);
    $cURLConnection = curl_init($url);
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    //for debug only!
    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $respfrom = curl_exec($cURLConnection);
    $respfrom = json_decode($respfrom, true);
    curl_close($cURLConnection);
    if (isset($_POST['submit']) && $_POST['submit'] == "Transact") {
        $postRequest = array("id" => $_SESSION['to']);
    } else {
        $postRequest = array("id" => $_POST['customer_id']);
    }
    $cURLConnection = curl_init($url);
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $respto = curl_exec($cURLConnection);
    $respto = json_decode($respto, true);
    curl_close($cURLConnection);

    if ($respfrom['status'] && $respto['status']) {
        $fromdata = $respfrom['data'];
        $todata = $respto['data'];
        $_SESSION['from'] = $fromdata['id'];
        $_SESSION['to'] = $todata['id'];
    }
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">From Account</div>
                    <div class="card-body text-dark">
                        <h5 class="card-title"><?php echo $fromdata['name'] ?></h5>
                        <p class="card-text"><?php echo $fromdata['email'] ?></p>
                        <p class="card-text">Available Amount:<?php echo $fromdata['amount'] ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 px-5">
                <?php if (!isset($_POST['submit'])) { ?>
                    <img src="./assets/images.png" alt="" height=150 class="mx-3">
                <?php } ?>
            </div>
            <div class="col-sm-4">
                <div class="card border-dark mb-3" style="max-width: 18rem;">
                    <div class="card-header">To Account</div>
                    <div class="card-body text-dark">
                        <h5 class="card-title"><?php echo $todata['name'] ?></h5>
                        <p class="card-text"><?php echo $todata['email'] ?></p>
                        <p class="card-text">Current Amount:<?php echo $todata['amount'] ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!isset($_POST['submit'])) { ?>
            <div class="container">
                <form method="POST">
                    <div class="form-group">
                        <label for="amount">Enter Amount to Transfer</label>
                        <input type="number" class="form-control" id="amount" placeholder="Enter amount" name="amount">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <br>
                    <input type="submit" value="Transact" name="submit" class="btn btn-primary" />
                </form>
            </div>
        <?php } ?>
    </div>


<?php

    require("./basedown.php");
}

?>