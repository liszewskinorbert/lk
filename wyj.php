<?php


$text=$_POST['variable'];
//echo $text;
$litery=strlen($text);
echo "Wpisales łącznie ".$litery." liter,";
echo "<br/>";
if ($litery<10)
{
echo "Łańcuch posiada mniej niż 10 znaków ";
}
else
{
	echo "Wpisany tekst dużymi literami to ".strtoupper($text);
}
echo "<br/>";

$łańcuch="";

for ($i=0; $i<$litery; $i++)
{
	if ($i%2==1)
	{
	//	$łańcuch+=.strtoupper($text[$i]);
		$łańcuch .=strtoupper($text[$i]); 
	}
	else
	{
		$łańcuch .=($text[$i]); 
	}
	
}
echo "Tekst pisany co druga duża litera to: ".$łańcuch;

?>
