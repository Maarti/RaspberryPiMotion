<!DOCTYPE html>
<html>
<head>
<title>Videos</title>
</head>
<body>
<h1>Vidéos</h1>

<?php
	$folder = __DIR__.'/cam/'.addslashes($_GET["date"]);
	$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
	$folderUrl = $rootUrl.'cam/'.addslashes($_GET["date"]);

	if (file_exists($folder.'/ovr/overview.mp4')){
		echo '<b><a href="'.$folderUrl.'/ovr/overview.mp4">OVERVIEW</b>';
	}

	if (is_dir($folder)){
		$pattern = $folder.'/*.mp4';
		foreach (glob($pattern) as $videoFullPath) {
			$video = $folderUrl.'/'.substr($videoFullPath,-18);
			$thumb1 = $folderUrl.'/'.substr($videoFullPath,-18,-3).'jpg';
			$hour = substr($videoFullPath,-10,2);
			$min = substr($videoFullPath,-8,2);
			$sec = substr($videoFullPath,-6,2);
			echo '<li><a href="'.$video.'"><img src="'.$thumb1.'" height="240" width="320"></a> '.$hour.'h'.$min.'	<i>('.filesize($videoFullPath).' octets)</i></li>
';
		}
		unset($video);
	}else{
		echo 'Dossier "'.htmlspecialchars($folder).'" inexistant';
	}
?>
</body>
</html>
