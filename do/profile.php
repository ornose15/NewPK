<?php
function viewProfile() {
	if(isset($_GET['id'])) {
		$comid = mysql_real_escape_string($_GET['id']);
	} else {
		$comid = -1;
	}
	if(!isset($comid)) {
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Profile Not Found</span></div>
		<div class='content'><div style='padding:5px'>No profile ID found.</div></div>";
		return 1;
	}
	$comments = mysql_query("SELECT * FROM newpk_users WHERE id='".$comid."'");
	if(mysql_num_rows($comments) < 1) {
		echo "
		<div class='ntitle'><span style='font-weight:bold'>Profile Not Found</span></div>
		<div class='content'><div style='padding:5px'>The profile ID you requested does not exist.</div></div>";
		return 1;
	}
	$row = mysql_fetch_array($comments);
	global $level;
	switch($row['level']) {
		case 1:
			$level = 'Member';
			break;
		case 2:
			$level = 'Moderator';
			break;
		case 3:
		case 4:
			$level = 'Administrator';
			break;
		default:
			$level = 'Member';
			break;
	}
	if((loggedIn()) && (getUser() == $row['name'])) {
		echo "
		<div class='ntitle'><span style='font-weight:bold'>View Profile - ". $row['name'] . " (You)</span></div>
		<div class='content'><div style='padding:5px'>
			Registered: " . date("M j, Y", $row['register_date']) . "<br />
			E-mail: " . $row['email'] . "<br />
			Posts: " . $row['posts'] . "<br />
			Level: " . $level . "<br />
			Status: " . $row['status'] . "<br />";
			if($row['status'] == 'Banned') {
				echo '<strong>User banned for:</strong> ' . $row['ban_reason'] . '<br />';
				echo '<strong>Banned by:</strong> ' . $row['banner'] . '<br />';
				echo '<strong>Banned on:</strong> ' . date("M j, Y", $row['ban_date']);
			}
		echo '</div></div>';
		echo "<div class='ntitle'><span style='font-weight:bold'>Edit Profile</span></div>
		<div class='content'><div style='padding:5px'><a href='do.php?action=edituser&amp;id=" . $row['id'] . "'>Click here to edit your profile.</a></div></div>
		";
		if((loggedIn()) && (getLevel() >= 3)) { 
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Admin Options</span></div>
			<div class='content'><div style='padding:5px'>";
				if($row['status'] == 'Active') {
					echo '<a href="do.php?action=banuser&amp;id=' . $row['id'] . '">Ban</a><br />';
				} else if($row['status'] == 'Banned') {
					echo '<a href="do.php?action=unbanuser&amp;id=' . $row['id'] . '">Unban</a><br />';
				}
				echo "
				<a href='do.php?action=ulevel&amp;id=" . $row['id'] . "'>Set User Level</a><br />
				<a href='do.php?action=deluser&amp;id=" . $row['id'] . "'>Delete Account</a>
			</div></div>";
		} else if((loggedIn()) && (getLevel() == 2)) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Mod Options</span></div>
			<div class='content'><div style='padding:5px'>";
				if($row['status'] == 'Active') {
					echo '<a href="do.php?action=banuser&amp;id=' . $row['id'] . '">Ban</a><br />';
				} else if($row['status'] == 'Banned') {
					echo '<a href="do.php?action=unbanuser&amp;id=' . $row['id'] . '">Unban</a><br />';
				}
				echo "
			</div></div>";
		}
	} else if(loggedIn()) {
		echo "
		<div class='ntitle'><span style='font-weight:bold'>View Profile - ". $row['name'] . "</span></div>
		<div class='content'><div style='padding:5px'>
			Registered: " . date("M j, Y", $row['register_date']) . "<br />
			Posts: " . $row['posts'] . "<br />
			Level: " . $level . "<br />
			Status: " . $row['status'] . "<br />";
			if($row['status'] == 'Banned') {
				echo '<strong>User banned for:</strong> ' . $row['ban_reason'] . '<br />';
				echo '<strong>Banned by:</strong> ' . $row['banner'] . '<br />';
				echo '<strong>Banned on:</strong> ' . date("M j, Y", $row['ban_date']);
			}
		echo '</div></div>';
		if((loggedIn()) && (getLevel() >= 3)) { 
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Admin Options</span></div>
			<div class='content'><div style='padding:5px'>";
				if($row['status'] == 'Active') {
					echo '<a href="do.php?action=banuser&amp;id=' . $row['id'] . '">Ban</a><br />';
				} else if($row['status'] == 'Banned') {
					echo '<a href="do.php?action=unbanuser&amp;id=' . $row['id'] . '">Unban</a><br />';
				}
				echo "
				<a href='do.php?action=ulevel&amp;id=" . $row['id'] . "'>Set User Level</a><br />
				<a href='do.php?action=deluser&amp;id=" . $row['id'] . "'>Delete Account</a>
			</div></div>";
		} else if((loggedIn()) && (getLevel() == 2)) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Mod Options</span></div>
			<div class='content'><div style='padding:5px'>";
				if($row['status'] == 'Active') {
					echo '<a href="do.php?action=banuser&amp;id=' . $row['id'] . '">Ban</a><br />';
				} else if($row['status'] == 'Banned') {
					echo '<a href="do.php?action=unbanuser&amp;id=' . $row['id'] . '">Unban</a><br />';
				}
			echo "</div></div>";
		}
	} else {
		echo "
		<div class='ntitle'><span style='font-weight:bold'>View Profile - ". $row['name'] . "</span></div>
		<div class='content'><div style='padding:5px'>
			Registered: " . date("M j, Y", $row['register_date']) . "<br />
			Posts: " . $row['posts'] . "<br />
			Level: " . $level . "<br />
			Status: " . $row['status'] . "<br />";
			if($row['status'] == 'Banned') {
				echo '<strong>User banned for:</strong> ' . $row['ban_reason'] . '<br />';
				echo '<strong>Banned by:</strong> ' . $row['banner'] . '<br />';
				echo '<strong>Banned on:</strong> ' . date("M j, Y", $row['ban_date']);
			}
		echo '</div></div>';
	}
	return 1;
}
viewProfile();
?>