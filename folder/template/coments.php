<?php

$db = new mysqli('localhost', 'root', '', 'lokalny1');
$db->set_charset('utf8');

// tu nieaktywne
$query = "SELECT * FROM comment ";
$resource = $db->query($query);
$movies_inactive = [];
while ($row = $resource->fetch_assoc()) {
    $movies_inactive[] = $row;
}
$resource->free();
header('Content-Type: application/json');
echo json_encode($movies_inactive); // tu generujemy JSON



?>