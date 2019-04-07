<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Podatki, rzecz pewna jak śmierć</title>
</head>
<body>


<form action="">
    <input type="number" name="netto" required step="0.01" min="0.01" max="1000000">
    <button type="submit">DALEJ</button>
</form>
<p>
    <?php
    $kwotanetto=0;
	$kwotabrutto=0;
	$vat=23;
	$kwotanetto=$_GET['netto'];
	$kwotabrutto=$kwotanetto+$kwotanetto*$vat/100;
	echo "Od wartości netto".$kwotanetto." kwota brutto wynosi:".$kwotabrutto;
  
    $kwotanetto1=0;
	$kwotanetto1 = $kwotabrutto/(1+($vat/100));
	echo '<br/>';
	
	echo "Testowo kwota netto ".$kwotanetto1;
	
    ?>
</p>

</body>
</html>