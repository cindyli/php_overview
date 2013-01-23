<?php
function get_places() {
    $sql = "SELECT username, place_id, place_name, created_date 
        FROM users u, places p 
        WHERE u.user_id = p.created_by";

    $result = mysql_query($sql);
    
    return $result;
}
?>