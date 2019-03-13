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
	if(isset($_POST['text'], $ip)) {
		$text = addslashes(strip_tags($_POST['text']));
		if(!is_empty($text) && !is_empty($ip)) {
			global $tit;
			$banner = getUser();
			$date = time();
			mysql_query("UPDATE newpk_users SET status='Banned', ban_reason='$text', banner='$banner', ban_date='$date', level='1' WHERE (last_ip='$ip')");
			mysql_query("INSERT INTO newpk_banlog (ip, banner, ban_date, reason, action) VALUES ('$ip', '$banner', '$date', '$text', 'Ban')");
			mysql_query("INSERT INTO newpk_bans (ip) VALUES ('$ip')");
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Ban IP - " . $ip . "</span></div>
			<div class='content'><div style='padding:5px'>IP address successfully banned.</div></div>";
		} else {
			$result = 'You <strong>must</strong> put a IP address and ban reason.<br /><br />';
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Ban IP</span></div>
			<div class='content'><div style='padding:5px'>" . $result . "Please provide a ban reason for future reference.<br /><br />
				<form action='admin.php?action=banip' method='post'>
				<div><input type='text' name='ip' value='$ip' class='input' /> IP Address</div>
				<div><textarea name='text' rows='5' cols='30' class='input'></textarea></div>
				<div><input type='submit' value='Ban' /></div>
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
				<div class='content'><div style='padding:5px'>You cannot ban a user of a higher or equal level as you.</div></div>";
				return 1;
			}
			if($result != 'success') {
				echo "
				<div class='ntitle'><span style='font-weight:bold'>Ban IP" . $tit  ."</span></div>
				<div class='content'><div style='padding:5px'>" . $result . "Please provide a ban reason for future reference.<br /><br />
					<form action='admin.php?action=banip' method='post'>
					<div><input type='text' name='ip' value='$ip' class='input' /> IP Address</div>
					<div><textarea name='text' rows='5' cols='30' class='input'></textarea></div>
					<div><input type='submit' value='Ban' /></div>
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