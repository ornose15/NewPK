<?php
if(isset($_GET['id'])) {
	$id = mysql_real_escape_string($_GET['id']);
} else {
	$id = -1;
}
if(isset($_POST['email'])) {
	$email = $_POST['email'];
	if((!is_empty($email)) && (!is_empty($_POST['oldpass']))) {
		$oldpass = hash('whirlpool', $_POST['oldpass']);
		$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$id."'");
		$row = mysql_fetch_array($comments);
		if((($row['name'] == getUser()) && ($oldpass == $row['pass']))) {
			mysql_query("UPDATE newpk_users SET email='$email' WHERE id='$id'");
			if(isset($_POST['newpass']) && !is_empty($_POST['newpass'])) {
				$newpass = hash('whirlpool', $_POST['newpass']);
				mysql_query("UPDATE newpk_users SET pass='$newpass' WHERE id='$id'");
			}
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Edit Profile</span></div>
			<div class='content'><div style='padding:5px'>Profile successfully updated.<br />You are being redirected.</div></div>";
			global $newpass;
			?>
			<script>
				<?php
				echo "var pass = '" . $newpass . "';\n";
				?>
				setCookie('pk_pass', pass, 30);
			</script>
			<?
			global $id;
			echo "<meta http-equiv='REFRESH' content='2;url=do.php?action=edituser&amp;id=$id'>";
		} else {
			$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$id."'");
			$row = mysql_fetch_array($comments);
			$result = 'Submitted password and recorded password don\'t match.<br /><br />';
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Edit Profile</span></div>
			<div class='content'><div style='padding:5px'>" . $result . "
				<form action='do.php?action=edituser&amp;id=$id' method='post'>
				<div><input type='text' name='email' size='30' class='input' value='" . $row['email'] . "' /> * Email</div>
				<div><input type='password' name='newpass' size='30' maxlength='30' class='input' value='' /> Change Password (leave blank to ignore)</div>
				<div><input type='password' name='oldpass' size='30' maxlength='30' class='input' value='' /> * Current Password (mandatory)</div>
				<div><input type='submit' value='Update' /></div>
				</form>
			</div></div>";
		}
	} else {
		$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$id."'");
		$row = mysql_fetch_array($comments);
		$result = 'All fields marked * are required.<br /><br />';
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Edit Profile</span></div>
		<div class='content'><div style='padding:5px'>" . $result . "
			<form action='do.php?action=edituser&amp;id=$id' method='post'>
			<div><input type='text' name='email' size='30' class='input' value='" . $row['email'] . "' /> * Email</div>
			<div><input type='password' name='newpass' size='30' maxlength='30' class='input' value='' /> Change Password (leave blank to ignore)</div>
			<div><input type='password' name='oldpass' size='30' maxlength='30' class='input' value='' /> * Current Password (mandatory)</div>
			<div><input type='submit' value='Update' /></div>
			</form>
		</div></div>";
	}
} else {
	function editUser() {
		global $result;
		if(!loggedIn()) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Not Authorized</span></div>
			<div class='content'><div style='padding:5px'>You must be logged in to do this action.</div></div>";
			return 1;
		}
		if(isset($_GET['id'])) {
			$comid = mysql_real_escape_string($_GET['id']);
		} else {
			$comid = -1;
		}
		if(!isset($comid)) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>User Not Found</span></div>
			<div class='content'><div style='padding:5px'>No user ID found.</div></div>";
			return 1;
		}
		$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$comid."'");
		if(mysql_num_rows($comments) < 1) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>User Not Found</span></div>
			<div class='content'><div style='padding:5px'>The user ID you requested does not exist.</div></div>";
			return 1;
		}
		$row = mysql_fetch_array($comments);
		if((loggedIn()) && ($row['name'] != getUser())) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Request Denied</span></div>
			<div class='content'><div style='padding:5px'>You cannot edit someone else's profile.</div></div>";
			return 1;
		}
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Edit Profile</span></div>
		<div class='content'><div style='padding:5px'>" . $result . "
			<form action='do.php?action=edituser&amp;id=$comid' method='post'>
			<div><input type='text' name='email' size='30' class='input' value='" . $row['email'] . "' /> * Email</div>
			<div><input type='password' name='newpass' size='30' maxlength='30' class='input' value='' /> Change Password (leave blank to ignore)</div>
			<div><input type='password' name='oldpass' size='30' maxlength='30' class='input' value='' /> * Current Password (mandatory)</div>
			<div><input type='submit' value='Update' /></div>
			</form>
			<br /><a href='do.php?action=deluser&amp;id=$comid'>Delete Account</a>
		</div></div>";
		return 1;
	}
	editUser();
}
?>