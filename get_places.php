<?php
include_once("include/config.php");
include_once("include/utilities.php");

$result = get_places();

$results = array();

while ($row = mysql_fetch_assoc($result)) {
    $results[] = $row;
}
header('application/json; charset=utf-8');

if (count($results) > 0) {
    echo json_encode($results);
}
?>