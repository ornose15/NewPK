<?php
if(isset($_GET['id'])) {
	$id = mysql_real_escape_string($_GET['id']);
} else {
	$id = -1;
}
if(isset($_POST['level'])) {
	$level = $_POST['level'];
	$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$id."'");
	$row = mysql_fetch_array($comments);
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Set Level - ". $row['name'] . "</span></div>
	<div class='content'><div style='padding:5px'>User account level successfully updated.<br />You are being redirected.</div></div>";
	mysql_query("UPDATE newpk_users SET level=" . intval($level) . " WHERE id='$id'");
	echo "<meta http-equiv='REFRESH' content='2;url=members.php'>";
} else {
	function setLevel() {
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
		if(loggedIn() && $row['name'] == getUser()) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Denied</span></div>
			<div class='content'><div style='padding:5px'>You can't set your own level.</div></div>";
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
			<div class='content'><div style='padding:5px'>You cannot set the account level of user a higher or equal level as you.</div></div>";
			return 1;
		}
		if($result != 'success') {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Set Level - ". $row['name'] . "</span></div>
			<div class='content'><div style='padding:5px'>Set a user level from 1 (Member) to 3 (Administrator).<br /><br />
				<form action='do.php?action=ulevel&amp;id=$comid' method='post'>
				<div><input type='text' name='level' value='".$row['level']."' /></div>
				<div><input type='submit' value='Set' /></div>
				</form>
			</div></div>";
		}
		return 1;
	}
	setLevel();
}
?>