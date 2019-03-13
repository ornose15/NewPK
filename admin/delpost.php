<?php
if(loggedIn() && getLevel() >= 3) {
	function delPost() {
		$res = '';
		if(isset($_GET['id'])) {
			$comid = mysql_real_escape_string($_GET['id']);
		} else {
			$comid = -1;
		}
		$comments = mysql_query("SELECT * FROM newpk WHERE id='".$comid."'");
		$row = mysql_fetch_array($comments);
		if(isset($_POST['req'])) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Delete Post - ". $row['title'] . "</span></div>
			<div class='content'><div style='padding:5px'>Post successfully deleted.<br />You are being redirected.</div></div>";
			mysql_query("UPDATE newpk_users SET posts=posts-1 WHERE name='" . $row['author'] . "'");
			mysql_query("DELETE FROM newpk_comments WHERE `post-id`='" . $row['id'] . "'");
			mysql_query("DELETE FROM newpk WHERE id='$comid'");
			setLatest();
			echo "<meta http-equiv='REFRESH' content='2;url=admin.php?action=posts'>";
			return 1;
		}
		if(!isset($comid)) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Post Not Found</span></div>
			<div class='content'><div style='padding:5px'>No post ID found.</div></div>";
			return 1;
		}
		if(mysql_num_rows($comments) < 1) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Post Not Found</span></div>
			<div class='content'><div style='padding:5px'>The post ID you requested does not exist.</div></div>";
			return 1;
		}
		if($res != 'success') {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Delete Post - ". $row['title'] . "</span></div>
			<div class='content'><div style='padding:5px'>Are you sure you want to delete this post?<br /><br />
				<form action='admin.php?action=delpost&amp;id=$comid' method='post'>
				<div><input type='hidden' name='req' value='yes' /></div>
				<div><input type='submit' value='Yes' /> <input type='button' value='No, cancel' onclick='window.location=\"admin.php?action=posts\";' /></div>
				</form>
			</div></div>";
		}
		return 1;
	}
	delPost();
} else {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Access Denied</span></div>
	<div class='content'><div style='padding:5px'>You are not authorized to enter the admin panel.</div></div>";
}
?>