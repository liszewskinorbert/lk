<?php
/**
 * Created by IntelliJ IDEA.
 * User: jaszczomp
 * Date: 2019.04.07
 * Time: 09:04
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="">
    <input type="text" name="year">
    <input type="text" name="month">
    <input type="text" name="day">
    <input type="submit" name="sendButton" value="DALEJ">
</form>
<pre>
<strong>Zadanie</strong>
Odbierz dane urodzin użytkownika i wskaż jaki to był dzień tygodnia.
</pre>

<p>
    <?php
     $data=$_GET['year']."-".$_GET['month']."-".$_GET['day'];
	 echo $data;
	 $czas=strtotime($data);  
	 $tydz = date("l", $czas);
	 echo $tydz; 
	 ?>


</p>
</body>
</html> 


