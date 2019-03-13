<?php
if(loggedIn() && getLevel() >= 2) {
	if(isset($_POST['ip'])) {
		$ip = mysql_real_escape_string($_POST['ip']);
		$tit = " - $ip";
	} else if(isset($_GET['ip'])) {
		$ip = mysql_real_escape_string($_GET['ip']);
		$tit = " - $ip";
	} else {
		$ip = '';
		$tit = '';
	}
	if(isset($ip)) {
		global $tit, $empty;
		if(!is_empty($ip)) {
			$banner = getUser();
			$date = time();
			echo $empty;
			mysql_query("UPDATE newpk_users SET status='Active', ban_reason='', banner='', ban_date='', level='1' WHERE (last_ip='$ip')");
			mysql_query("INSERT INTO newpk_banlog (ip, banner, ban_date, reason, action) VALUES ('$ip', '$banner', '$date', 'Unban', 'Unban')");
			mysql_query("DELETE FROM newpk_bans WHERE ip='$ip'");
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Unban IP - " . $ip . "</span></div>
			<div class='content'><div style='padding:5px'>IP address successfully unbanned.</div></div>";
		} else {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Unban IP</span></div>
			<div class='content'><div style='padding:5px'>
				<form action='admin.php?action=unbanip' method='post'>
				<div><input type='text' name='ip' value='$ip' class='input' /> IP Address</div>
				<div><input type='submit' value='Unban' /></div>
				</form>
			</div></div>";
		}
	} else {
		function banUser() {
			global $result, $ip, $tit;
			if(!isset($ip)) {
				echo "
				<div class='ntitle'><span style='font-weight:bold'>IP Not Found</span></div>
				<div class='content'><div style='padding:5px'>No IP address found.</div></div>";
				return 1;
			}
			if((loggedIn()) && getUser() == $ip) {
				echo "
				<div class='ntitle'><span style='font-weight:bold'>Request Denied</span></div>
				<div class='content'><div style='padding:5px'>You cannot ban your own IP address.</div></div>";
				return 1;
			}
			$comments = mysql_query("SELECT * FROM newpk_users WHERE '$ip'=newpk_users.last_ip");
			$row = mysql_fetch_array($comments);
			if($row['level'] >= getLevel()) {
				echo "
				<div class='ntitle'><span style='font-weight:bold'>Request Denied</span></div>
				<div class='content'><div style='padding:5px'>You cannot unban a user of a higher or equal level as you.</div></div>";
				return 1;
			}
			if($result != 'success') {
				echo "
				<div class='ntitle'><span style='font-weight:bold'>Unban IP" . $tit  ."</span></div>
				<div class='content'><div style='padding:5px'>" . $result . "
					<form action='admin.php?action=unbanip' method='post'>
					<div><input type='text' name='ip' value='$ip' class='input' /> IP Address</div>
					<div><input type='submit' value='Unban' /></div>
					</form>
				</div></div>";
			}
			return 1;
		}
		banUser();
	}
} else {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Access Denied</span></div>
	<div class='content'><div style='padding:5px'>You are not authorized to enter the admin panel.</div></div>";
}
?>