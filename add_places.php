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

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/styles.css">
<body>
    <div class="fadeout"></div>
    <div class="topBar">
        <h1>Welcome <?php echo $username; ?></h1>
        
        <div class="navbar">
            <div class="navbar-inner">
                <label class="brand">Add places where you want to eat on Thursday:</label>
                <ul class="nav">
                    <li>
                        <form class="navbar-form pull-left" action="" method="post">
                            <input type="text" name="place" />
                            <button type="submit" class="btn" value="submit">Submit</button>
                        </form>
                    </li>
                    <?php if($username == $special_user) { ?>
                    <li class="divider-vertical"></li>
                    <li>
                        <form class="navbar-form" action="random.php" method="post">
                            <button type="submit" class="btn" value="submit">Pick a random place from the list</button>
                        </form>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    
    <form class="results" action="" method="post>
        <div class="results">
            <?php
            while ($row = mysql_fetch_assoc($result)) {
                $myRow = $deleteIcon = "";
                if ($row["username"] == $username) {
                    $myRow = "alert-success";
                    $deleteIcon = "<button class='close pull-left'>&times;</button>";
                }
                // Notice string concatenation using "."
                echo "<div class='well " . $myRow . "'><h3>". $deleteIcon . "&nbsp;" . $row["place_name"] . "</h3> was suggested by " . $row["username"] . " <div class='pull-right'> at " . $row["created_date"] . "</div></div>";
            } 
            ?>
        </div>
    </form>

</body>