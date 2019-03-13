<?php
if(isset($_GET['id'])) {
	$id = mysql_real_escape_string($_GET['id']);
} else {
	$id = -1;
}
if(isset($_POST['text'])) {
	$text = addslashes(strip_tags($_POST['text']));
	if(!is_empty($text)) {
		mysql_query("UPDATE newpk_users SET status='Banned', ban_reason='$text', banner='". getUser() ."', ban_date='". time() ."', level='1' WHERE id='$id'");
		$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$id."'");
		$row = mysql_fetch_array($comments);
		$banner = getUser();
		$date = time();
		mysql_query("INSERT INTO newpk_banlog (ip, banner, ban_date, reason, action) VALUES ('" . $row['last_ip'] . "', '$banner', '$date', '$text', 'Ban')");
		mysql_query("INSERT INTO newpk_bans (ip) VALUES ('" . $row['last_ip'] . "'");
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Ban User - ". $row['name'] . "</span></div>
		<div class='content'><div style='padding:5px'>User successfully banned.</div></div>";
	} else {
		$result = 'You <strong>must</strong> put a ban reason.<br /><br />';
	}
} else {
	function banUser() {
		global $result;
		if(isset($_GET['id'])) {
			$comid = mysql_real_escape_string($_GET['id']);
		} else {
			$comid = -1;
		}
		$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$comid."'");
		$row = mysql_fetch_array($comments);
		if((!loggedIn()) || (loggedIn() && $row['name'] != getUser() && getLevel() < 2)) {
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
		if(loggedIn() && $row['name'] == getUser()) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Request Denied</span></div>
			<div class='content'><div style='padding:5px'>You cannot ban yourself.</div></div>";
			return 1;
		}
		if($row['status'] == 'Banned') {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Request Denied</span></div>
			<div class='content'><div style='padding:5px'>User is already banned.</div></div>";
			return 1;
		}
		if(loggedIn() && $row['level'] >= getLevel()) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Request Denied</span></div>
			<div class='content'><div style='padding:5px'>You cannot ban a user of a higher or equal level as you.</div></div>";
			return 1;
		}
		if($result != 'success') {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Ban User - ". $row['name'] . "</span></div>
			<div class='content'><div style='padding:5px'>" . $result . "Please provide a ban reason for future reference.<br /><br />
				<form action='do.php?action=banuser&amp;id=$comid' method='post'>
				<div><textarea name='text' rows='5' cols='30' class='input'></textarea></div>
				<div><input type='submit' value='Ban' /></div>
				</form>
			</div></div>";
		}
		return 1;
	}
	banUser();
}
?>