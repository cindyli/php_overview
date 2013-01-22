<?php

$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "root";
$mysql_database = "php_overview";

$special_user = "alexcindy";

$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
or die("Error connecting to mysql host: " . mysql_error());
mysql_select_db($mysql_database, $bd) or die("Error connecting to database: " . mysql_error());

?>