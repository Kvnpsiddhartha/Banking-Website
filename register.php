<?php
session_start();
require("./baseup.php");
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pswd = md5($_POST['pswd']);
    $amount = $_POST['amount'];
    $postRequest = array(
        'name' => $name,
        'email' => $email,
        'password' => $pswd,
        'amount' => $amount
    );

    $cURLConnection = curl_init('http://localhost/Banking%20Website/backend/register.php');
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $apiResponse = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    // $apiResponse - available data from the API request
    $response = json_decode($apiResponse, true);

    if ($response['status']) {
        $_SESSION['userid'] = $response['userid'];
        require("./navigation.php");
        echo "<h1>Registration Successful</h1>";
    } else {
        require("./navigation.php");
        echo "<h1>Registration Unsuccessful</h1>";
    }
} else {
    require("./navigation.php");
?>
    <div class="container">
        <div class="login-box">
            <h1>Register</h1>
            <form id="login-form" method="POST">
                <div class=" mb-3 row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inputName" name="name">
                    </div>
                </div>
                <div class=" mb-3 row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="inputEmail" name="email">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword" name="pswd">
                    </div>
                </div>
                <div class=" mb-3 row">
                    <label for="inputAmount" class="col-sm-2 col-form-label">Initial Amount</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="inputAmount" name="amount">
                    </div>
                </div>
                <input type="submit" value="register" class="btn btn-primary" name="register">
                <h4 id="status-text"></h4>
            </form>
        </div>
    </div>

<?php
}
require("./basedown.php")
?>