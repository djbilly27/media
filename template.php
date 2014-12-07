<?php
class template
{
	private $cssClass = "";
	public function cwd() //gets the current working current directory without the document root.
	{
		$root = $_SERVER['DOCUMENT_ROOT'];
		$currentDir = getcwd();
		return substr($currentDir, strlen($root));
	}
	public function dbConnect() // connects to database using the config file.
	{
		$dbUser = file_get_contents("config/databaseUser.txt");
		$dbUser = explode("\n",$dbUser);
		$con = mysqli_connect("localhost","$dbUser[0]","$dbUser[1]","$dbUser[2]");
		return $con;
	}
	public function login($suppliedUser, $suppliedPass)
	{
			session_start();
			$con = $this->dbConnect();
			$suppliedUser = mysqli_real_escape_string($con, $suppliedUser);
			$suppliedPass = mysqli_real_escape_string($con, $suppliedPass);
			$sql = "SELECT id, username, password, userGroup, activated FROM users WHERE username = '$suppliedUser' LIMIT 1;"; //sql query to get the information from the database
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_row($query);
			if($row[4] === 0){
				return "<h2>Account isn't active.</h2>";
			}
			elseif($row[4] == 2)
			{
				return "<h2>Account has been banned.</h2>";
			}
			mysqli_close($con); //closing database connection.
			if(password_verify($suppliedPass,$row[2])) //checking if the password matches.
			{
				$root = $this->cwd();
				$_SESSION['username'] = $row[1]; //setting session variables.
				$_SESSION['activity'] = time();
				$_SESSION['group'] = $row[3];
				header("Location: $root ");
			} 
			else
			{
				return "<h2>Invalid username or password. <br/> Please try again.</h2>"; // message that the user didn't have valid information.
			}
	}
	public function isMobile() //checks the user agent to see what operating system they are using.
	{
		if (stripos($_SERVER['HTTP_USER_AGENT'], "android") !== false){ return true; }
		return false;
	}
	public function styles()
	{
		if ($this->isMobile())
		{ 
		?>
			<link href="/media/css/mobilestyle.php" rel="stylesheet" type="text/css" />	
		<?php
		}
		else
		{
		?>
			<link href="/media/css/style.php" rel="stylesheet" type="text/css" />
		<?php
		}
	}
	public function register($fName, $lName, $user, $pass, $cPass, $ip) //checks the database for the user's information please don't pass potentiona
	{
		$con = $this->dbConnect();
		$fName = mysqli_real_escape_string($con, strip_tags($fName));
		$lName = mysqli_real_escape_string($con, strip_tags($lName));
		$user = mysqli_real_escape_string($con, strip_tags($user));
		$user = strtolower($user);
		$pass = mysqli_real_escape_string($con, strip_tags($pass));
		$cPass = mysqli_real_escape_string($con, strip_tags($cPass));
		$ip = mysqli_real_escape_string($con, strip_tags($ip));
		if(preg_match('/\s/',$fName) || preg_match('/\s/',$lName) || preg_match('/\s/',$user) || preg_match('/\s/',$pass) || preg_match('/\s/',$cPass))
		{
			$msg = "<h2>No spaces allowed.</h2>";
		}
		else
		{
			if($pass == $cPass) //All of these if statements just check the registration info.
			{
				if(strlen($fName) > 30 || strlen($lName) > 30)
				{
					$msg = "<h2>Names cannot be longer than 30 characters.</h2>";
				}
				else if(strlen($fName) < 3 || strlen($lName) < 3)
				{
					$msg = "<h2>Names cannot be less than 3 characters.</h2>";
				}
				elseif(strlen($user) > 20)
				{
					$msg = "<h2>Usernames cannot be longer than 20 characters.</h2>";
				}
				elseif(strlen($user) < 3)
				{
					$msg = "<h2>Usernames cannot be shorter than 3 characters.</h2>";
				}
				elseif(strlen($pass)>55)
				{
					$msg = "<h2>Password cannot be longer than 55 characters.</h2>";
				}
				elseif(strlen($pass)<6)
				{
					$msg = "<h2>Password cannot be shorter than 6 characters.</h2>";
				}
				else
				{
					$sql = "SELECT username FROM users WHERE username = '$user';";
					$sql2 = "SELECT regdate, ip FROM users WHERE ip = '$ip' ORDER BY id DESC";
					$result = mysqli_query($con, $sql);
					$result2 = mysqli_query($con, $sql2);
					$count2 = mysqli_num_rows($result2);
					$count = mysqli_num_rows($result);
					$row = mysqli_fetch_row($result2);
					if($count != 0)
					{
						$msg = "<h2>Username has been taken</h2>";
					}
					else
					{
						if($count2 < 5)
						{
							$pass = password_hash($pass,PASSWORD_DEFAULT);
							mysqli_query($con,"INSERT INTO users (username,password,firstname,lastname,regdate, ip, userGroup, activated) VALUES ('$user', '$pass', '$fName', '$lName', now(), '$ip','standard', '0')");
							$msg = "<h3>Your account has been created. However, the administrator has to activate the account.";
						
						}
						else
						{
							$hours = $this->compareDate($row[0]);
							if($hours >= 24)
							{
								$pass = password_hash($pass,PASSWORD_DEFAULT);
								mysqli_query($con,"INSERT INTO users (username,password,firstname,lastname,regdate, ip) VALUES ('$user', '$pass', '$fName', '$lName', now(), '$ip','standard', '0')");
								$msg = "<h3>Your account has been created. However, the administrator has to activate the account.";
							}
							else
							{
								$msg = "<h2>To many registrations with that IP address Please try again in " . (24 - $hours) . " hours <h2>";
							}
						}
					}
					mysqli_close($con);
				}
			}
			else
			{
				$msg = "<h2>Passwords do not match</h2>";
			}
		}
		return $msg;
	}
	public function startSessionRestricted() // use if site should be restricted to registered users.
	{
		session_start();
		$dir = $this->cwd();
		$difference = time() - $_SESSION['activity'];
		if(!isset($_SESSION['username']))
		{
			header("Location: $dir/login.php");
		}
		else if($difference > 86400)
		{
			unset($_SESSION);
			session_destroy();
			header("Location: $dir/login.php");
		}
		else
		{
			$username = $_SESSION['username'];
			$con = $this->dbConnect();
			$sql = "SELECT activated FROM users WHERE username = '$username' LIMIT 1;"; //sql query to get the information from the database
			$query = mysqli_query($con, $sql);
			$row = mysqli_fetch_row($query);
			if($row[0] == 2)
			{
				unset($_SESSION);
				session_destroy();
				header("Location: $dir/login.php");
			}
			$_SESSION['activity'] = time();
		}
		if($_SESSION['group'] == "admin")
		{
			$con = $this->dbConnect();
			$sql = "SELECT activated FROM users WHERE activated = '0';";
			$query = mysqli_query($con, $sql);
			if(mysqli_num_rows($query) != 0)
			{
				$this->setClass('class="newUser"');
			}
		}
}
	public function getClass()
	{
		return $this->cssClass;
	}
	public function setClass($var)
	{
		$this->cssClass = $var;
	}
	public function startSessionAdmin() // use if site should be restricted to admins. This site currently does not use it.
	{
		$this->startSessionRestricted();
		if(!($_SESSION['group'] == "admin")) 
		{
			$dir = $this->cwd();
			header("Location: $dir");
		}
	}
	public function customScrollLazyLoad()
	{
		if (!$this->isMobile())
		{ 
		?>
		<script src="javascript/jquery-2.1.0.min.js"></script>
		<script src="javascript/jquery.mCustomScrollbar.concat.min.js"></script>
		<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css" />
		<script>
			(function($){
				$( document ).ready(function(){
					$("#recentlyAddedWrapper").mCustomScrollbar({
						axis:"x",
						scrollbarPosition: "inside",
						autoHideScrollbar: true,
						advanced:{autoExpandHorizontalScroll:true}
					});
					$("#main").mCustomScrollbar({
							axis:"y",
							scrollbarPosition: "inside",
							autoHideScrollbar: true,
							advanced:{autoExpandHorizontalScroll:true},
							setRight: "500px"
					});
				});
			})(jQuery);
		</script>
		<?php
		}
	}
	public function createPage($title, $function = "") //creates opening tags and accepts a page title..
	{	
?>
		<!doctype html>
		<html>
		<head>
		<title><?php echo $title; ?></title>
		<meta name="viewport" content="minimal-ui, width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta http-equiv="Cache-control" content="public">
		<meta charset="UTF-8">
		<?php
		
		if(!empty($function)){$this->$function(); $this->loadBar();}
?>
		</head>	
		<body>
		<?php $this->styles(); 
		?>
		<div id ="wrapper">
		<div id="searchbar">
		<form action ="movies.php" method="post" style="margin-top: 5px;">
			<input id="submit" type="submit" value="Search" name="search" style="height: 17px;" />
			<input type="search" id="textfield" name="searchtext"/>
		</form>
		</div>
		<?php if(!$this->isMobile()){ include "header.php"; } ?>
		<div id = "main" >
	<?php
	}
	public function endPage() //echos the closing tags of the html page.
	{
	?>
		</div>
		<?php if($this->isMobile()){ include "header.php"; } ?>
		</div>
		</body>
		</html>
	<?php
	}
	function loadBar()
	{
		?>
		<script src="javascript/pace.js"></script>
		<link href="css/pace-theme-minimal.css" rel="stylesheet" />
	<?php
	}
	function compareDate($dateToCompare) // returns the difference of the current date to the date provided in hours.
	{
		date_default_timezone_set('America/Detroit');
		$currentDate = (strtotime(date('Y-m-d H:i:s')));
		$otherDate = (strtotime($dateToCompare));
		$difference = ($currentDate - $otherDate)/3600;
		return round($difference,2);
	}
	function secondsToTime($seconds) // converts seconds into hours minutes seconds.
	{
		$H = floor($seconds / 3600);
		$i = ($seconds / 60) % 60;
		$s = $seconds % 60;
		return sechof("%02d:%02d:%02d", $H, $i, $s);
	}
	function videojsScripts()
	{
	?>
		<link href="http://vjs.zencdn.net/4.10/video-js.css" rel="stylesheet">
		<script src="http://vjs.zencdn.net/4.10/video.js"></script>
		<style type="text/css">
		.vjs-default-skin .vjs-play-progress,
		.vjs-default-skin .vjs-volume-level { background-color: #ff0000 }
		.vjs-default-skin .vjs-big-play-button { background: rgba(0,0,0,1) }
		.vjs-default-skin .vjs-slider background: rgba(0,0,0,0.3333333333333333) }
		</style>
	<?php
	}
	function videojs($videoname, $width, $height)
	{
		if($this->isMobile())
		{
			//$width = $width/2;
			//$height = $height/2;
		}
		?>
		<video id="MY_VIDEO_1" class="video-js vjs-default-skin vjs-big-play-centered"  controls preload="false"
		width="<?php print $width; ?>" height="<?php print $height; ?>"
		data-setup="{}">
		<source src="<?php print $videoname; ?>" type='video/mp4'>
		<p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
		</video>
		<?php
	}
	function lazyload($container)
	{
	?>
		<script type="text/javascript">
		</script>
	<?php
	}
	function get_random_string($length)
	{
		$random_string = "";
		$valid_chars = "abcdefghijklmnopqrstuvwxyz1234567890";
		$num_valid_chars = strlen($valid_chars);
		for ($i = 0; $i < $length; $i++)
		{
			$random_pick = mt_rand(1, $num_valid_chars);
			$random_char = $valid_chars[$random_pick-1];
			$random_string .= $random_char;
		}
		return $random_string;
	}
}
?>