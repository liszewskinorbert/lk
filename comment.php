<?php


// uzupełnijmy dane - brakujące: created_at,
$record = $_POST;
$record['created_at'] = time(); // time() zwraca ilośc sekund od 1970-01-01 01:00:00


// walidacja
// wywalam znaczniki, niebezpieczne znaki  - "" oraz '' - i whitespaces i zastąpienie wulgaryzmów na [***]
$record['content'] = strip_tags($record['content']);
$record['content'] = addslashes($record['content']);
$record['content'] = trim($record['content']);
$bad_words = [
	'dupa',
	'pierd',
	'chuj',
	'huj',
	'hooy',
	'kurw'
];
$replacement = "[***]";
$record['content'] = str_replace($bad_words, $replacement, $record['content']);
$record['author'] = str_replace($bad_words, $replacement, $record['author']);

// dostajemy sie do bazy danych
$db = new mysqli('localhost', 'root', '', 'lokalny1',3307);
$db->set_charset('utf8');

// budujemy query: INSERT INTO....
$query = "INSERT INTO comment (id, review_id, content, author, created_at) 
VALUES (
NULL, 
'{$record['review_id']}', 
'{$record['content']}', 
'{$record['author']}', 
'{$record['created_at']}'
)";
// wysyłamy zapytanie
$resource = $db->query($query);
// $resource->free();
// disconnect z bazą
$db->close();

// wracamy do strony
// - albo za pomocą adresu referencyjnego (*)
// - albo za pomocą własnej konstrukcji linka

header('Location: '.$_SERVER['HTTP_REFERER']);
exit;