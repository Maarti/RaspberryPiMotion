<!DOCTYPE html>
<html>
<head>
	<title>Dates</title>
	<style>
	body
	{
		color:white;
		background-color: #152836;
		font-size:20px;
	}
	ul{margin-left:10px;}
	li{margin-bottom:20px; font-size:30px}
	a{color:white}
	</style>
</head>
<body>
	<h1>Dates</h1>
	<hr/>
	<div>
	<ul>
	<?php
	$dir = '/var/www/html/cam';
	$dirs = scandir($dir, 1);	// 0 = croissant,  >0 = decroissant

	foreach ($dirs as $num => $dir_name){
		// $dir_name est de la forme "20160825"
		if(substr($dir_name,0,1)!='.'){		
			$year = substr($dir_name,0,4);
			$month = substr($dir_name,4,2);
			$day = substr($dir_name,6,2);
			$timestamp = strtotime($year.'-'.$month.'-'.$day);
			$dayStr = date('D', $timestamp);
			$dir_display = $dayStr.' '.$day.'/'.$month.'/'.$year;

			echo '<li><a href=video.php?date='.$dir_name.'>'.$dir_display.'</a></li>';
		}
	}
	unset($num);
	unset($dir_name);
	?>
	</ul>
	</div>
</body>
</html>
