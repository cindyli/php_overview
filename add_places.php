<?php
include_once("include/config.php");
session_start();

if (!isset($_SESSION["login_user"]) || trim($_SESSION["login_user"]) == "") {
    echo "You don't have privilege to access this page, please <a href=\"login.php\">login</a> first.";
    exit;
}

$username = $_SESSION["login_user"];

if (isset($_POST["place"]) && trim($_POST["place"]) != "") {
    $place = addslashes($_POST["place"]);

    $sql = sprintf("INSERT INTO places(place_name, created_by, created_date)
            SELECT '%s', user_id, now()
            FROM users
            WHERE username = '%s'", $place, $username);
            
    $result = mysql_query($sql);
}

$sql = "SELECT username, place_name, created_date 
        FROM users u, places p 
        WHERE u.user_id = p.created_by";

$result = mysql_query($sql);
?>

<body>
    <h1>Welcome <?php echo $username; ?></h1>

    <form action="" method="post">
        <label>Add places you wish to travel to:</label>
        <input type="text" name="place" />
    
        <input type="submit" value="Submit "/><br />
    </form>
    
    <table>
    <?php
    while ($row = mysql_fetch_assoc($result)) {
        // Notice string concatenation using "."
        echo "<span style=\"color: blue\">". $row["place_name"] ."</span> was added by " . $row["username"] . " at " . $row["created_date"] . "<br />";
    } 
    ?>
    </table>
</body>