<?php 

$title = [
	"Don't cry because it's over, smile because it happened.",
	"Be yourself; everyone else is already taken.",
	"So many books, so little time.",
	"A room without books is like a body without a soul.",
	"You only live once, but if you do it right, once is enough.",
	"No one can make you feel inferior without your consent.",
];
// VARIABLES
$hour = date('H');
$_class = 'night';
$year = date('Y');
$menu = [
	'Strona główna' => 'index.php',
	'Artykuły' => 'index.php?page=articles',
	'Kontakt' => 'index.php?page=contact',
];


$c_file = 'index';
$params = $_GET;




// CODE
if ($hour >= 8 and $hour <=18 ){
	$_class = 'day';
}


if (!empty($params['page']) && file_exists(__dir__.'/../_data/content_'.$params['page'].'.php')) {
	$c_file = $params['page']; 
}

?>
