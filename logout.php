<?php
session_start();
require("./baseup.php");
if (session_destroy()) {
    unset($_SESSION['userid']);
    require("./navigation.php");
    echo "<h1>Thank you for using Bank Management System</h1>";
}
require("./basedown.php");
