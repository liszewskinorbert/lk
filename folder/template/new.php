<?php

$db = new mysqli('localhost', 'root', '', 'lokalny1');
$db->set_charset('utf8');

// tu nieaktywne
$query = "SELECT * FROM movie WHERE active=0 ORDER BY id ASC LIMIT 5";
$resource = $db->query($query);
$movies_inactive = [];
while ($row = $resource->fetch_assoc()) {
    $movies_inactive[] = $row;
}
$resource->free();

header('Content-Type: application/json');
echo json_encode($movies_inactive); // tu generujemy JSON


?>