<?php
// ustanawiam połączenie z bazy
$db = new mysqli('localhost','root','','lokalny1',3307); // serwer, user, hasło, baza
$db-> set_charset('utf-8');


$query = "SELECT * FROM movie where active=1 order by year desc LIMIT 5";
$query2 = "SELECT * FROM movie where active=0 order by year desc LIMIT 5"; // zapytanie do pobierania danych
$resource = $db->query($query);
$resource2 = $db->query($query2); // inicjuję wysyłkę zapytania - do zmiennej resources
$movies = [];
$movies2 = [];

while ( $row = $resource->fetch_assoc() ) { // pobieram do zmiennej $row zawartość jednego rekordu pobranego z $resources
    //print_r($row);
    //echo '<h3>'.$row['title'].'</h3>';
    $movies[] = $row;
}
while ( $row = $resource2->fetch_assoc() ) { // pobieram do zmiennej $row zawartość jednego rekordu pobranego z $resources
    //print_r($row);
    //echo '<h3>'.$row['title'].'</h3>';
    $movies2[] = $row;
}
$resource->free();
$resource2->free(); // zwalniam zasoby po pobieraniu danych

// tu mogę dokonać więcej operacji pobierania itp
// ...



$db->close(); // zamykam połączenie z bazą
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Favourite movies!</title>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 </head>
<body>


<div class="container-fluid row">
	<div class="col">
		<?php foreach ($movies as $movie): ?>
		    <h3><?= $movie['title'] ?> (<?= $movie['year']  ?>)</h3>
		    <h5 data-toggle="collapse" style="color: red;" data-target="#movie-<?= $movie['id']  ?>">Description</h5>
		    <p class="collapse card bg-light" id="movie-<?= $movie['id']  ?>"><?= $movie['description'] ?></p>
		<?php endforeach; ?>		
	</div>
	<div class="col">
		<?php foreach ($movies2 as $movie): ?>
		    <h3><?= $movie['title'] ?> (<?= $movie['year']  ?>)</h3>
		    <h5 data-toggle="collapse" style="color: red;" data-target="#movie-<?= $movie['id']  ?>">Description</h5>
		    <p class="collapse card bg-light" id="movie-<?= $movie['id']  ?>"><?= $movie['description'] ?></p>
		<?php endforeach; ?>		
	</div>
</div>























</body>
</html>