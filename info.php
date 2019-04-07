<html>
<head>
  <meta http-equiv="refresh" content="30">
</head>




<?php

$minuta = date('i');
echo $minuta;
echo "<br>";


 if (($minuta % 2) == 1)
  { echo "Minuta nieparzysta" ;}
  if (($minuta % 2) == 0)
  { echo "Minuta parzysta" ;}

?>
</html> 