<?php
include_once("include/config.php");

session_start();

if(isset($_SESSION["login_user"]) && trim($_SESSION["login_user"]) == $special_user) {
    $sql = "SELECT * FROM places ORDER BY RAND() LIMIT 0,1;";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);

    // If result matched $myusername, table should have at least 1 row
    if(mysql_num_rows($result) != 0) {
        $place = $row['place_name'];
    }
} else {
    header("location: login.php");
    exit;
}

?>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<div class="navbar">
    <div class="navbar-inner">
        <ul class="nav">
            <li>
                <button type="submit" class="btn" value="submit">Go Back</button>
            </li>
        </ul>
    </div>
</div>

<div class="well alert-success">
    Aha! We are going to <h2><?php echo $place; ?></h2>
</div>