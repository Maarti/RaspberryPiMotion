<!DOCTYPE html>
<html>
<head>
<title>Vidéos</title>
</head>
<body>
<?php
$dir = '/var/www/html/cam';

	$dirs = scandir($dir, 1);	// 0 = croissant,  >0 = decroissant

	//print_r($dirs);

	foreach ($dirs as $num => $dir_name){
		if(substr($dir_name,0,1)!='.'){
		// $dir_name est de la forme "20160825"
		//$dir_exp = explode("-", $dir_name);
		$year = substr($dir_name,0,4);
		$month = substr($dir_name,4,2);
		$day = substr($dir_name,6,2);
		//$dir_display = $dir_exp[2].'/'.$dir_exp[1].'/'.$dir_exp[0];
		$dir_display = $day.'/'.$month.'/'.$year;

		echo '<li><a href=video.php?date='.$dir_name.'>'.$dir_display.'</a></li>';
		}
	}

	unset($num);

	unset($dir_name);
?>
</body>
</html>
