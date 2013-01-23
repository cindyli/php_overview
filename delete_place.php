<?php
include_once("include/config.php");
session_start();

if (!isset($_SESSION["login_user"]) || trim($_SESSION["login_user"]) == "") {
    echo "You don't have privilege to access this page, please <a href=\"login.php\">login</a> first.";
    exit;
}

function send_error_and_exit($error) {
    header("HTTP/1.0 400 Bad Request");
    echo json_encode($error);
    exit;
}

$username = $_SESSION["login_user"];

if (!isset($_POST['id']) || intval($_POST["id"]) == 0) {
    send_error_and_exit("Missing place ID");
}

$place_id_to_delete = intval($_POST["id"]);

// main process

// 1. make sure the login user is the owner of this record
$sql = "SELECT * FROM users, places WHERE username='".$username."' AND user_id = created_by";
$result = mysql_query($sql);
if (mysql_num_rows($result) == 0) {
    send_error_and_exit("You have no privilege to delete this record.");
}

// 2. DELETE
$sql = "DELETE FROM places WHERE place_id = '".$place_id_to_delete."'";
$result = mysql_query($sql);

?>