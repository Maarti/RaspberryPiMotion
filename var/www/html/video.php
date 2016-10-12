<!DOCTYPE html>
<html>
   <head>
      <title>Vid&eacute;o</title>
      <link type="text/css" rel="stylesheet" href="dist/css/lightgallery.min.css" />
      <link href="dist/css/style.css" rel="stylesheet" />
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   </head>
   <body class="home">
   
<?php
	$folder = __DIR__.'/cam/'.addslashes($_GET["date"]);
	$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
	$folderUrl = $rootUrl.'cam/'.addslashes($_GET["date"]);
	$dateStr = substr($_GET["date"],6,2).'/'.substr($_GET["date"],4,2).'/'.substr($_GET["date"],0,4);

	echo '<h1 class="white">Vid&eacute;os du '.$dateStr.'</h1>';
	$localOverview = $folder.'/ovr/overview.mp4';
	if (file_exists($localOverview)){
		echo ' <fieldset style="text-align:center;" class="white"><br/><b><a href="'.$folderUrl.'/ovr/overview.mp4" class="white">OVERVIEW</a></b><br/>
		<i style="font-size:11px;">Cr&eacute;&eacute;e le '.date('j M à H:i',filemtime($localOverview)).'</i><br/></fieldset>';
	}

	if (is_dir($folder)){
		$pattern = $folder.'/*.mp4';
		$i = 0;
		foreach (glob($pattern) as $videoFullPath) {
			$i++;
			$video = $folderUrl.'/'.substr($videoFullPath,-18);
			//echo '<li><a href="'.$video.'"><img src="'.$thumb.'" height="240" width="320"></a> '.$hour.'h'.$min.'	<i>('.filesize($videoFullPath).' octets)</i></li>';
		?>
		      <!-- Hidden video div -->
		      <div style="display:none;" id="video<?php echo $i ?>">
			 <video class="lg-video-object lg-html5" controls preload="none">
			    <source src="<?php echo $video ?>" type="video/mp4">
			    Your browser does not support HTML5 video.
			 </video>
		      </div>
		<?php 
			} 		
			unset($video);
		?>
		<br/>
		<div class="video-gallery">		
		<ul id="html5-videos" class="list-unstyled row">	 
		<?php
			$i = 0;
			foreach (glob($pattern) as $videoFullPath) {
			$i++;
			$thumb = $folderUrl.'/'.substr($videoFullPath,-18,-3).'jpg';
			$hour = substr($videoFullPath,-10,2);
			$min = substr($videoFullPath,-8,2);
			//$sec = substr($videoFullPath,-6,2);
		?>
		    <li class="col-xs-6 col-sm-4 col-md-3 video" data-poster="<?php echo $thumb ?>" data-sub-html="<h4><?php echo $hour.'h'.$min; ?></h4>" data-html="#video<?php echo $i ?>">
		       <a href="" class="thumb-title white">
			  <img class="img-responsive" src="<?php echo $thumb ?>">
			  <div class="video-gallery-poster">
			     <img src="dist/img/play-button.png">
			  </div>
		       <?php echo $hour.'h'.$min; ?>
		       </a>
		    </li>   
		<?php 
			} 		
			unset($video);
		?>		    
         </ul>
		
	<?php		
	}else{
		echo 'Dossier "'.htmlspecialchars($folder).'" inexistant';
	}
?>
   
    


      </div>
      <script type="text/javascript">
         $(document).ready(function() {
         	$("#lightgallery").lightGallery(); 
         	$('#html5-videos').lightGallery(); 
         });
      </script>
      <script src="dist/js/lightgallery.js"></script>
      <script src="dist/js/lg-fullscreen.js"></script>
      <script src="dist/js/lg-video.js"></script>
      <script src="dist/js/lg-thumbnail.js"></script>    
      <script src="lib/jquery.mousewheel.min.js"></script>
   </body>
</html>

