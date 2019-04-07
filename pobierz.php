<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pobierz dane z NBP</title>
</head>
<body>


<form action="">
   
    <button type="submit" name="getCurrency" value="1">POBIERZ</button>
</form>
<p>
    <?php
	
	
	if (isset($_GET['getCurrency']) && $_GET['getCurrency']==1)
	{
		$table='a';
		$url="http://api.nbp.pl/api/exchangerates/tables/".$table.'/';
		
		echo $url;
		$data = file_get_contents($url);
		echo $data;
		
		$jsonTable = json_decode($data, 1);
		echo '<pre>';
		print_r($jsonTable);
		echo '</pre>';
		$wanted = ['USD', 'EUR', 'GBP'];
		$listWanted=[];
		$result=[];
		
		foreach ($jsonTable[0]['rates'] as $rate) {
		if (in_array($rate['code'], $wanted)){
			$result[]=$rate;
		}
		
		}
			print_r($result);
	}
	
?>
</p>

</body>
</html>