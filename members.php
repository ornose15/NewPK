<?php
require_once('CONF_mysql.php');
$max = 30;
$cur = (($page * $max) - $max);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite - Members</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link href="images/favicon.ico" rel="shortcut icon" />
</head>

<body>

<div class="header">
	<?php require_once('GLOBAL_header.php'); ?>
</div>

<div class="ulwrap">
	<?php require_once('GLOBAL_toplinks.php'); ?>
</div>

<div class="wrapper">
	<div class="main">
		<?php
		$tot=mysql_query("SELECT * FROM newpk_users");
		$total = mysql_num_rows($tot);
		if($total != 0)
		{
			$result = mysql_query("SELECT * FROM newpk_users ORDER BY id ASC LIMIT $cur, $max") or die("Query failed with error: ".mysql_error());
			$total_pages = ceil($total / $max);
			echo "<div class='ntitle'><span style='font-weight:bold'>Members</span></div>";
			echo '<div class="content"><div style="padding:5px">';
			echo '<table width="100%">';
			echo '<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Registered</th>
				<th>Posts</th>
				<th>Level</th>
				<th>Status</th>
				';
				if(loggedIn() && getLevel() >= 2) {
					echo '<th>Action</th>';	
				}
				echo '
				</tr>
			';
			while($rows = mysql_fetch_array($result)) {
				global $level;
				switch($rows['level']) {
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
				echo '<tr>';
				echo '<td>' . $rows['id'] . '</td>' . '<td><a href="do.php?action=profile&amp;id=' . $rows['id'] . '">' . $rows['name'] . '</a></td>' . '<td>' . date("M j, Y", $rows['register_date']) . '</td>' . '<td>' . $rows['posts'] . '</td>' .
					'<td>' . $level . '</td>' . '<td>' . $rows['status'] . '</td>';
				if(loggedIn() && getLevel() >= 3) {
					if($rows['status'] == 'Active') {
						echo '<td><a href="do.php?action=banuser&amp;id=' . $rows['id'] . '">Ban</a> &#183; <a href="do.php?action=ulevel&amp;id=' . $rows['id'] . '">Set Level</a> &#183; <a href="do.php?action=deluser&amp;id=' . $rows['id'] . '">Delete</a></td>';
					} else if($rows['status'] == 'Banned') {
						echo '<td><a href="do.php?action=unbanuser&amp;id=' . $rows['id'] . '">Unban</a> &#183; <a href="do.php?action=ulevel&amp;id=' . $rows['id'] . '">Set Level</a> &#183; <a href="do.php?action=deluser&amp;id=' . $rows['id'] . '">Delete</a></td>';
					}
				} else if(loggedIn() && getLevel() == 2) {
					if($rows['status'] == 'Active') {
						echo '<td><a href="do.php?action=banuser&amp;id=' . $rows['id'] . '">Ban</a></td>';
					} else if($rows['status'] == 'Banned') {
						echo '<td><a href="do.php?action=unbanuser&amp;id=' . $rows['id'] . '">Unban</a></td>';
					}
				}
				echo '</tr>';
			}
			echo '</table></div></div>
			<div class="paginate">';
				if($page > 1)
				{
					$prev = ($page - 1);
					echo '<a href="?action=comments&amp;page=' . $prev . '" style="margin-right:20px">&laquo; Previous</a>';
				}
				if($page < $total_pages)
				{
					$next = ($page + 1);
					echo '<a href="?action=comments&amp;page=' . $next . '">Next &raquo;</a>';
				}
			echo '</div>';
		} else {
			echo "<div class='ntitle'><span style='font-weight:bold'>No Members</span></div>";
			echo '<div class="content"><div style="padding:5px">There\'s no one registered on the site.</div></div>';	
		}
		?>
    </div>
	
	<div class="sideboxes">
		<?php require_once('GLOBAL_sideboxes.php'); ?>
	</div>
	
	<div class="copyright">Design and content copyright &copy; <?php date_default_timezone_set("America/New_York"); echo date("Y"); ?> Pyrokid.</div>
</div>

</body>

</html>