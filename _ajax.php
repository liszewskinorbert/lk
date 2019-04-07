<?php


$db = new mysqli('localhost', 'root', '', 'lokalny1',3306);
$db->set_charset('utf8');

// tu aktywne
$query = "SELECT * FROM movie WHERE active=1 ORDER BY year ASC LIMIT 5";
$resource = $db->query($query);
$movies_active = [];
while ($row = $resource->fetch_assoc()) {
    $movies_active[] = $row;
}
$resource->free();

 header('Content-Type: application/json');
 echo json_encode($movies_active);
 
?>