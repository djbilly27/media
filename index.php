
<?php 
require "vendor/autoload.php";
$core = new core();
$core->startSessionRestricted();
$core->createPage("Simple Media Streamer");
if($core->getBrowser() != "Firefox")
{
	$movieFiles = glob("movies/*.{mp4,mkv,avi,MP4,MKV,AVI}",GLOB_BRACE );
}
else
{
	$movieFiles = glob("movies/*.{mp4,avi,MP4,AVI}",GLOB_BRACE );
}
$movieFiles = array_combine($movieFiles, array_map("filemtime", $movieFiles));
arsort($movieFiles);
$movieFiles = array_keys($movieFiles);

?>
<?php
$cw = @file_get_contents("Logs/".$_SESSION['username']."_cw.json");
if($cw !== false && $cw != '[]')
{
	$cw = json_decode($cw,true);
	$name = array_reverse(array_keys($cw));
	echo '<h1 style="text-shadow: 5px 3px 5px rgba(0,0,0,0.75); margin-top: 50px;">Currently Watching</h1>'.PHP_EOL;
	echo '<div id="recentlyAddedWrapper">'.PHP_EOL;

	
	foreach($name as $media)
	{
		$value = basename($media);
		$getvalue = urlencode($value);
		$title = substr($value,0,strlen($value)-4);
		$title2 = $title;
		if(strlen($title) > 17) { $title = substr($title,0,17) . "..."; }
		if(strpos($media,"movies") !== false)
		{
			echo '<div id="PosterContainer" style="margin-top: 5px;" onclick=\'javascript:location.href="movies.php?movie='.$getvalue.'&time='.$cw["$media"][0].'"\'>'.PHP_EOL;
			echo '<label style="cursor:pointer; text-shadow: 5px 3px 5px rgba(0,0,0,0.75);">'.$title.'</label><br>'.PHP_EOL;
			echo '<img  id="posters" alt="'.$title2.'" src="'."metadata/movies/$title2".'.jpeg"><br>'.PHP_EOL;
			echo '<progress value="'.$cw["$media"][0].'" max="'.$cw["$media"][1].'"></progress>'.PHP_EOL;
			echo '</div>'.PHP_EOL;
			
			
		}
		else
		{
			$title = $core->clean($title);
			$show = str_replace("shows/","",$media);
			
			$filename = explode("/",$show);
			if(count($filename) == 3)
			{
				$getvalue = urlencode($filename[0])."&season=".urlencode($filename[1])."&episode=".urlencode($filename[2]);
			}
			else if(count($filename) == 2)
			{
				$getvalue = urlencode($filename[0])."&episode=".urlencode($filename[1]);
			}
			echo '<div id="PosterContainer" style="margin-top: 5px;" onclick=\'javascript:location.href="shows.php?show='.$getvalue.'&time='.$cw["$media"][0].'"\'>'.PHP_EOL;

			echo '<label style="cursor:pointer; text-shadow: 5px 3px 5px rgba(0,0,0,0.75);">'.$title.'</label><br>'.PHP_EOL;
			echo '<img  id="posters" alt="'.$title2.'" src="'."metadata/shows/$filename[0]".'.jpeg"><br>'.PHP_EOL;
			echo '<progress value="'.$cw["$media"][0].'" max="'.$cw["$media"][1].'"></progress>'.PHP_EOL;
			echo '</div>'.PHP_EOL;
		}
		
	}
	echo '</div>'.PHP_EOL;
}

if(count($movieFiles) > 0)
{
	echo '<h1 style="text-shadow: 5px 3px 5px rgba(0,0,0,0.75); margin-top: 50px;">Recently Added Movies</h1>'.PHP_EOL;
	echo '<div id="recentlyAddedMovies">'.PHP_EOL;
	$num = 15;
	if($num > count($movieFiles))
	{
		$num = count($movieFiles);
	}
	for($i = 0; $i < $num; $i++)
	{
		$value = basename($movieFiles[$i]);
		$getvalue = urlencode($value);
		$movieInfo = @file_get_contents("metadata/movies/".substr($value,0,strlen($value)-4).".txt");
		if($movieInfo !== FALSE)
		{
			$title = substr($value,0,strlen($value)-4);
			$title2 = $title;
			if(file_exists("metadata/movies/$title2.jpeg"))
			{
				if(strlen($title) > 17) { $title = substr($title,0,17) . "..."; }
				if($movieInfo == "No information") { $movieInfo = $title2; }
				echo '<div id="PosterContainer" style="margin-top: 5px;" onclick=\'javascript:location.href="movies.php?movie='.$getvalue.'"\'>'.PHP_EOL;
				echo '<label style="cursor:pointer; text-shadow: 5px 3px 5px rgba(0,0,0,0.75);">'.$title.'</label><br>'.PHP_EOL;
				echo '<img  id="posters" alt="'.$title2.'" src="'."metadata/movies/$title2".'.jpeg">'.PHP_EOL;
			}
			echo '</div>'.PHP_EOL;
		}
		else{if(($num + 1) < count($movieFiles)){$num = $num + 1;}}
	}
	echo '</div>'.PHP_EOL;
}
?>
<?php $core->endPage(); ?>
