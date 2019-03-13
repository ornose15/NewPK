<?php
if(isset($_GET['id'])) {
	$id = mysql_real_escape_string($_GET['id']);
} else {
	$id = -1;
}
if(isset($_POST['req'])) {
	$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$id."'");
	$row = mysql_fetch_array($comments);
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Delete Account - ". $row['name'] . "</span></div>
	<div class='content'><div style='padding:5px'>User account successfully deleted.<br />You are being redirected.</div></div>";
	mysql_query("DELETE FROM newpk_users WHERE id='$id'");
	mysql_query("DELETE FROM newpk_comments WHERE author='". $row['name'] . "'");
	echo "<meta http-equiv='REFRESH' content='2;url=index.php'>";
} else {
	function delUser() {
		global $result;
		if(isset($_GET['id'])) {
			$comid = mysql_real_escape_string($_GET['id']);
		} else {
			$comid = -1;
		}
		$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$comid."'");
		$row = mysql_fetch_array($comments);
		if((!loggedIn()) || (loggedIn() && $row['name'] != getUser() && getLevel() < 3)) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Not Authorized</span></div>
			<div class='content'><div style='padding:5px'>You are not authorized to do this action.</div></div>";
			return 1;
		}
		if(!isset($comid)) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>User Not Found</span></div>
			<div class='content'><div style='padding:5px'>No user ID found.</div></div>";
			return 1;
		}
		if(mysql_num_rows($comments) < 1) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>User Not Found</span></div>
			<div class='content'><div style='padding:5px'>The user ID you requested does not exist.</div></div>";
			return 1;
		}
		if((loggedIn()) && ($row['level'] >= getLevel()) && ($row['name'] != getUser())) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Request Denied</span></div>
			<div class='content'><div style='padding:5px'>You cannot delete a user of a higher or equal level as you.</div></div>";
			return 1;
		}
		if($result != 'success') {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Delete Account - ". $row['name'] . "</span></div>
			<div class='content'><div style='padding:5px'>Are you sure you want to delete this account?<br /><br />
				<form action='do.php?action=deluser&amp;id=$comid' method='post'>
				<div><input type='hidden' name='req' value='yes' /></div>
				<div><input type='submit' value='Yes' /> <input type='button' value='No, cancel' onclick='window.location=\"index.php\";' /></div>
				</form>
			</div></div>";
		}
		return 1;
	}
	delUser();
}
?>