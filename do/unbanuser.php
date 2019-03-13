<?php
function unbanUser() {
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
			<div class='content'><div style='padding:5px'>You cannot unban yourself.</div></div>";
			return 1;
		}
		if($row['status'] != 'Banned') {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Request Denied</span></div>
			<div class='content'><div style='padding:5px'>User is not banned.</div></div>";
			return 1;
		}
		if(loggedIn() && $row['level'] >= getLevel()) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Request Denied</span></div>
			<div class='content'><div style='padding:5px'>You cannot unban a user of a higher or equal level as you.</div></div>";
			return 1;
		}
		mysql_query("UPDATE newpk_users SET status='Active', ban_reason='', banner='', ban_date='' WHERE id='$comid'");
		$banner = getUser();
		$date = time();
		mysql_query("INSERT INTO newpk_banlog (ip, banner, ban_date, reason, action) VALUES ('" . $row['last_ip'] . "', '$banner', '$date', 'Unban', 'Unban')");
		mysql_query("DELETE FROM newpk_bans WHERE ip='" . $row['last_ip'] . "'");
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Unban User - ". $row['name'] . "</span></div>
		<div class='content'><div style='padding:5px'>User successfully unbanned.</div></div>";
		return 1;
	}
	unbanUser();
?>