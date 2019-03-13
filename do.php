<?php
require_once('CONF_mysql.php');
if(isset($_GET['action'])) {
	$action = mysql_real_escape_string($_GET['action']);
} else {
	$action = 'unknown';
}
switch($action) {
	case 'register':
		$title = 'Register';
		break;
	case 'login':
		$title = 'Log In';
		break;
	case 'logout':
		$title = 'Log Out';
		break;
	case 'delcom':
		$title = 'Delete Comment';
		break;
	case 'profile':
		$title = 'View Profile';
		break;
	case 'banuser':
		$title = 'Ban User';
		break;
	case 'unbanuser':
		$title = 'Unban User';
		break;
	case 'ulevel':
		$title = 'Set User Level';
		break;
	case 'deluser':
		$title = 'Delete User';
		break;
	case 'edituser':
		$title = 'Edit User';
		break;
	default:
		$title = 'Unknown';
		break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite - <?php echo $title; ?></title>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link href="images/favicon.ico" rel="shortcut icon" />
	<script>
		function setCookie(c_name, value, exdays)
		{
			var exdate=new Date();
			exdate.setDate(exdate.getDate() + exdays);
			var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
			document.cookie=c_name + "=" + c_value;
		}
	</script>
</head>

<body>

<div class="header">
	<?php require_once('GLOBAL_header.php'); ?>
</div>

<div class="ulwrap">
	<?php require_once('GLOBAL_toplinks.php'); ?>
</div>

<div class="wrapper">
	<div class="main">
		<?php
		if($action == 'register') {
			require_once('./do/register.php');
		} else if($action == 'login') {
			require_once('./do/login.php');
		} else if($action == 'logout') {
			require_once('./do/logout.php');
		} else if($action == 'delcom') {
			require_once('./do/delcom.php');
		} else if($action == 'profile') {
			require_once('./do/profile.php');
		} else if($action == 'banuser') {//
			require_once('./do/banuser.php');
		} else if($action == 'unbanuser') {//
			require_once('./do/unbanuser.php');
		} else if($action == 'ulevel') {
			require_once('./do/ulevel.php');
		} else if($action == 'deluser') {
			require_once('./do/deluser.php');
		} else if($action == 'edituser') {
			require_once('./do/edituser.php');
		} else {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Unknown Request</span></div>
			<div class='content'><div style='padding:5px'>The action you requested is not available.</div></div>";
		}
		?>
    </div>
	
	<div class="sideboxes">
		<?php require_once('GLOBAL_sideboxes.php'); ?>
	</div>
	
	<div class="copyright">Design and content copyright &copy; <?php date_default_timezone_set("America/New_York"); echo date("Y"); ?> Pyrokid.</div>
</div>

</body>

</html>