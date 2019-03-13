<?php
require_once('CONF_mysql.php');
if(isset($_GET['action'])) {
	$action = mysql_real_escape_string($_GET['action']);
} else {
	$action = 'unknown';
}
if(getLevel() >= 3) {
	switch($action) {
		case 'posts':
			$title = 'Admin: All Posts';
			break;
		case 'newpost':
			$title = 'Admin: New Post';
			break;
		case 'delpost':
			$title = 'Admin: Delete Post';
			break;
		case 'editpost':
			$title = 'Admin: Edit Post';
			break;
		case 'comments':
			$title = 'Admin: All Comments';
			break;
		case 'delcom':
			$title = 'Admin: Delete Comment';
			break;
		case 'banip':
			$title = 'Admin: Ban IP';
			break;
		case 'unbanip':
			$title = 'Admin: Unban IP';
			break;
		case 'bans':
			$title = 'Admin: Ban Log';
			break;
		default:
			$title = 'Admin Panel';
			break;
	}
} else if(getLevel() == 2) {
	switch($action) {
		case 'comments':
			$title = 'Mod: All Comments';
			break;
		case 'delcom':
			$title = 'Mod: Delete Comment';
			break;
		case 'banip':
			$title = 'Mod: Ban IP';
			break;
		case 'unbanip':
			$title = 'Mod: Unban IP';
			break;
		case 'bans':
			$title = 'Mod: Ban Log';
			break;
		default:
			$title = 'Mod Panel';
			break;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite - <?php global $title; echo $title; ?></title>
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
		if(loggedIn() && getLevel() >= 3) {
			if($action == 'posts') {
				require_once('./admin/posts.php');
			} else if($action == 'newpost') {
				require_once('./admin/newpost.php');
			} else if($action == 'delpost') {
				require_once('./admin/delpost.php');
			} else if($action == 'editpost') {
				require_once('./admin/editpost.php');
			} else if($action == 'comments') {
				require_once('./admin/comments.php');
			} else if($action == 'delcom') {
				require_once('./admin/delcom.php');
			}  else if($action == 'banip') {
				require_once('./admin/banip.php');
			} else if($action == 'unbanip') {
				require_once('./admin/unbanip.php');
			} else if($action == 'bans') {
				require_once('./admin/bans.php');
			} else {
				echo "
				<div class='ntitle'><span style='font-weight:bold'>Welcome to the Admin Panel</span></div>
				<div class='content'><div style='padding:5px'>
					Click a link below manage the website.<br /><br />
					<ul class='sidebar'>
						<li><a href='admin.php?action=posts'>View all posts</a></li>
						<li><a href='admin.php?action=newpost'>Make a new post</a></li>
						<li><a href='admin.php?action=posts'>Edit a post</a></li>
						<li><a href='admin.php?action=comments'>View all comments</a></li>
						<li><a href='members.php'>Manage members</a></li>
						<li><a href='admin.php?action=banip'>Ban an IP</a></li>
						<li><a href='admin.php?action=bans'>View ban log</a></li>
					</ul>
				</div></div>";
			}
		} else if(loggedIn() && getLevel() == 2) {
			if($action == 'comments') {
				require_once('./admin/comments.php');
			} else if($action == 'delcom') {
				require_once('./admin/delcom.php');
			}  else if($action == 'banip') {
				require_once('./admin/banip.php');
			} else if($action == 'unbanip') {
				require_once('./admin/unbanip.php');
			} else if($action == 'bans') {
				require_once('./admin/bans.php');
			} else {
				echo "
				<div class='ntitle'><span style='font-weight:bold'>Welcome to the Admin Panel</span></div>
				<div class='content'><div style='padding:5px'>
					Click a link below moderate the website.<br /><br />
					<ul class='sidebar'>
						<li><a href='admin.php?action=comments'>View all comments</a></li>
						<li><a href='members.php'>Manage members</a></li>
						<li><a href='admin.php?action=banip'>Ban an IP</a></li>
						<li><a href='admin.php?action=bans'>View ban log</a></li>
					</ul>
				</div></div>";
			}
		} else {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Access Denied</span></div>
			<div class='content'><div style='padding:5px'>You are not authorized to enter the admin panel.</div></div>";
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