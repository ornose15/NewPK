<?php
function delCom() {
	if(isset($_GET['comid'])) {
		$comid = mysql_real_escape_string($_GET['comid']);
	} else {
		$comid = -1;
	}
	if(!isset($comid)) {
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Request Not Found</span></div>
		<div class='content'><div style='padding:5px'>No comment ID found.</div></div>";
		return 1;
	}
	$comments = mysql_query("SELECT * FROM newpk_comments WHERE `id`='".$comid."'");
	if(mysql_num_rows($comments) < 1) {
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Request Not Found</span></div>
		<div class='content'><div style='padding:5px'>The comment ID you requested does not exist.</div></div>";
		return 1;
	}
	$row = mysql_fetch_array($comments);
	if((!loggedIn() && getLevel() < 2) || ($_SERVER['REMOTE_ADDR'] != $row['ip']) && (getLevel() < 2)) {
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Delete Comment Failed</span></div>
		<div class='content'><div style='padding:5px'>You cannot delete a comment that is not your own.</div></div>";
		return 1;
	}
	if((loggedIn() && getLevel() >= 2) || ($_SERVER['REMOTE_ADDR'] == $row['ip'])) {
		mysql_query("DELETE FROM newpk_comments WHERE `id`='".$comid."'");
		if(loggedIn()) {
			mysql_query("UPDATE newpk_users SET posts=posts-1 WHERE name='" . $row['author'] . "'");
		}
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Delete Comment</span></div>
		<div class='content'><div style='padding:5px'>Comment was successfully deleted.</div></div>";
	}
	return 1;
}
delCom();
?>