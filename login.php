<?php
session_start();
require("./baseup.php");
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pswd = md5($_POST['pswd']);
    $postRequest = array(
        'email' => $email,
        'password' => $pswd
    );

    $cURLConnection = curl_init('http://localhost/Banking%20Website/backend/login.php');
    curl_setopt($cURLConnection, CURLOPT_POSTFIELDS, $postRequest);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $apiResponse = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    // $apiResponse - available data from the API request
    $response = json_decode($apiResponse, true);


    if ($response['status']) {
        $_SESSION['userid'] = $response['userid'];
        // echo $_SESSION['userid'];
        require("./navigation.php");
        // echo $_SESSION['userid'];
        echo "<h1>Login Successful</h1>";
    } else {
        require("./navigation.php");
        echo "<h1>Please enter Correct Details</h1>";
    }
} else {
    require("./navigation.php");
?>
    <div class="container">
        <div class="login-box">
            <h1>Login </h1>
            <form id="login-form" method="POST">
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
                <input type="submit" value="login" class="btn btn-primary" name="login">
                <h4 id="status-text"></h4>
            </form>
        </div>
    </div>

<?php
}
require("./basedown.php")
?>