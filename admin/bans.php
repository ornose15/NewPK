<?php
if(loggedIn() && getLevel() >= 2) {
	if(isset($_GET['page']) && is_numeric($_GET['page']))
	{
		$page = mysql_real_escape_string($_GET['page']);
	} else {
		$page = 1;
	}
	$max = 30;
	$cur = (($page * $max) - $max);
	$tot=mysql_query("SELECT * FROM newpk_banlog");
	$total = mysql_num_rows($tot);
	if($total != 0)
	{
		$result = mysql_query("SELECT * FROM newpk_banlog ORDER BY ban_date DESC LIMIT $cur, $max") or die("Query failed with error: ".mysql_error());
		$total_pages = ceil($total / $max);
		echo "<div class='ntitle'><span style='font-weight:bold'>Ban Log</span></div>";
		echo '<div class="content"><div style="padding:5px">';
		echo '<table width="100%">';
		echo '<tr>
			<th>IP</th>
			<th>By</th>
			<th>Date</th>
			<th>Reason</th>
			<th>Motive</th>
			<th>Action</th>
			</tr>
		';
		while($rows = mysql_fetch_array($result)) {
			$reason = str_replace(array("\r\n", "\r", "\n"), ' ', $rows['reason']);
			echo '<tr>
				<td>' . $rows['ip'] . '</td>
				<td>' . $rows['banner'] . '</td>
				<td>' . date("M j, Y", $rows['ban_date']) . '</td>
				<td>' . $reason . '</td>
				<td>' . $rows['action'] . '</td>
				<td>'; if($rows['action'] != 'Unban') { echo '<a href="admin.php?action=unbanip&amp;ip=' . $rows['ip']  . '">Unban</a>'; } echo '</td>';
			echo '</tr>';
		}
		echo '</table></div></div>
		<div class="paginate">';
		if($page > 1)
		{
			$prev = ($page - 1);
			echo '<a href="?action=bans&amp;page=' . $prev . '" style="margin-right:20px">&laquo; Previous</a>';
		}
		if($page < $total_pages)
		{
			$next = ($page + 1);
			echo '<a href="?action=bans&amp;page=' . $next . '">Next &raquo;</a>';
		}
		echo '</div>';
	} else {
		echo "<div class='ntitle'><span style='font-weight:bold'>No Bans</span></div>";
		echo '<div class="content"><div style="padding:5px">No ban records were found.</div></div>';
	}
} else {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Access Denied</span></div>
	<div class='content'><div style='padding:5px'>You are not authorized to enter the admin panel.</div></div>";
}
?>