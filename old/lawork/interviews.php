<?php require_once('Connections/connector.php'); ?>
<?php
if (isset($_POST['pwd'])) {$_POST['pwd'] = sha1($_POST['pwd']); }
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['pwd'];
  $MM_fldUserAuthorization = "admin_priv";
  $MM_redirectLoginSuccess = "success.php";
  $MM_redirectLoginFailed = "loginfail.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connector, $connector);
  	
  $LoginRS__query=sprintf("SELECT username, pwd, admin_priv FROM users WHERE username=%s AND pwd=%s",
  GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connector) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'admin_priv');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>la work</title>



<!--[if IE]>
<style type="text/css"> 
/* place css fixes for all versions of IE in this conditional comment */
.twoColElsLtHdr #sidebar1 { padding-top: 30px; }
.twoColElsLtHdr #mainContent { zoom: 1; padding-top: 15px; }
/* the above proprietary zoom property gives IE the hasLayout it needs to avoid several bugs */
</style>
<![endif]-->
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>

<link href="style_interview.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style6 {
	color: #660066;
	font-weight: bold;
}
.style7 {
	font-size: 12px
}
a:visited {
	color: #8BC53F;
}
a:active {
	color: #660066;
}
-->
</style>
</head>

<body class="twoColElsLtHdr">

<div id="container">
  <div id="header">
    <form id="login" name="login" method="POST" action="<?php echo $loginFormAction; ?>">
      <p>
        <label for="username"><span class="style3"> Username:</span></label>
        <span class="green">
        <input type="text" name="username" id="username" />
      </span></p>
      <p> <span class="green">
        <label for="pwd"><span class="style2">Password:</span></label>
        </span>
          <input name="pwd" type="password" />
          <a href="register_user.php"></a></p>
      <p align="center" class="style3"><a href="register_user.php">Register</a></p>
        <input name="doLogin" type="submit" class="style3" id="doLogin" value="Log in" />
      </p>
    </form>
    <div class="green" id="nav">
      <div align="right">
        <p><a href="index.php">Home</a> |<a href="about.php"> About</a> | <a href="event.php">Events</a> | <a href="locations.php">Locations</a> | <a href="interviews.php">Interviews</a>| <a href="gallery.php">Gallery</a></p>
      </div>
    </div>
    <!-- end #header -->
  <img src="images/logo.gif" alt="Lawork" width="167" height="73" border="0" usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="4,4,215,102" href="index.php" />
</map></div>
  <div id="sidebar1">
    <div id="Interviews">Interviews</div>
    <div class="green" id="view01"><img src="images/gen.gif" width="66" height="58" /><a href="interviews.php">Legal grind </a><br/>
      <span class="style1 style4">" I would rather get paid for my skills than get arrested. "</span></div>
    <div class="green" id="view02"><img src="images/fern.gif" width="66" height="58" /><a href="interviews2.php">One chance</a> <br/>
   	<span class="style1"><span class="style4">" I took the opportunity and now I don't want to go </span>back.</span></div>
  <div class="green" id="view03"> <a href="interviews3.php"><img src="images/train.gif" width="66" height="58" /></a><a href="interviews3.php">For the rush</a> <br/>
    	<span class="style5"> " I can't let it go, I am like a thief in the night."</span></div>
    <div id="calendar">Events</div>
    <!--events-->
    <div id="events">
      <p class="green"><a href="event.php">May 18:</a> <span class="style1">Mother Falcon Clothing Presents: Charles Marklin</span></p>
      <p class="green"><a href="event.php">May 23 :</a> <span class="style1">Scion Presents: 1000 Days </span></p>
      <p class="green"><a href="event.php">June 4:</a> <span class="style1">ARTundresed</span></p>
      <p class="green"><a href="event.php">June 5:</a> <span class="style1">Junebug Arts Festival</span></p>
    </div>
  <!-- end #sidebar1 --></div>
  <!-- This clearing element should immediately follow the #mainContent div in order to force the #container div to contain all child floats -->
  <div class="about" id="content"> 
    <p align="center">Interviews</p>
    <p align="center" class="style7"><a href="interviews.php">Legal Grind</a>	|<a href="interviews2.php" class="green"> One Chance</a> | <a href="interviews3.php">For The Rush </a></p>
    <p align="center" class="style6">&nbsp;</p>
    <p align="left" class="green">GENEVIEVE19 years old <br />
      Los Angeles, California <br />
    United States </p>
    <p align="justify" class="style1">Tell use a little about yourself:</p>
      <p align="justify" class="style1">My name is Genevieve. I currently live in Los  Angeles and I am attending the Art Institute majoring in Interactive  Media Design. My main focus right now is school. I produce music on the  side as well as photography and some design work. I love to write and I  like to keep my head in the books. I am a graf artist and have been for  awhile now...I love Hip Hop. As far as music though I am very  versitile...hip hop is my first love but I love rock, oldies, etc...I  like almost everything pretty much. I like to have fun, and go out  every so often but I really like to stay home and relax just as much.  Most would describe me as a quiet person which I am, but I do like a  good conversation. </p>
      <p align="justify" class="style1">Do you still go out to paint?</p>
      <p align="justify" class="style1">I have done allot of running and dodging from cop throughout my days and it sure is a rush but I know chances are I wont always get away and the price to pay is pretty grimy. I only go out if I feel there isn't a soul around the area so I can paint in peace, or sometimes I rather just get a canvas and hit that up and sell it. Then I get paid for my skill rather than getting arrested.</p>
  </div>
    <p align="left">&nbsp;</p>
    <p align="left">&nbsp;</p>
    <p align="left"><br class="clearfloat" />
    </p>
</div>
<div id="footer">
  <p align="center" class="style3">copyright &copy; 2009 LA Work</p>
<!-- end #footer --></div>
<!-- end #container --></div>
</body>
</html>
