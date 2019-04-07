<?php

$pesel="77030301234";
$znaki=strlen($pesel);
//echo $znaki;
$wynik=0;
for ($i=0; $i<$znaki; $i++)
{
	$wynik=$wynik+$pesel[$i];
}
echo "Suma numeru pesel ".$pesel." wynosi ".$wynik;
?>


