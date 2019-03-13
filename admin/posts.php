<?php
if(loggedIn() && getLevel() >= 3) {
	if(isset($_GET['page']) && is_numeric($_GET['page']))
	{
		$page = mysql_real_escape_string($_GET['page']);
	} else {
		$page = 1;
	}
	$max = 20;
	$cur = (($page * $max) - $max);
	$tot=mysql_query("SELECT * FROM newpk");
	$total = mysql_num_rows($tot);
	if($total != 0)
	{
		$result = mysql_query("SELECT * FROM newpk ORDER BY id DESC LIMIT $cur, $max") or die("Query failed with error: ".mysql_error());
		$total_pages = ceil($total / $max);
		echo "<div class='ntitle'><span style='font-weight:bold'>Posts</span></div>";
		echo '<div class="content"><div style="padding:5px">';
		echo '<table width="100%">';
		echo '<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Author</th>
			<th>Date Posted</th>
			<th>Open</th>
			<th>Action</th>
			</tr>
		';
		while($rows = mysql_fetch_array($result)) {
			echo '<tr>
				<td>' . $rows['id'] . '</td>
				<td><a href="index.php#' . $rows['safe-title'] . '">' . $rows['title'] . '</a></td>
				<td>' . $rows['author'] . '</td>
				<td>' . date("M j, Y", $rows['date']) . '</td>
				<td>' . $rows['open'] . '</td>
				<td><a href="admin.php?action=editpost&amp;id=' . $rows['id']  . '">Edit</a> &#183; <a href="admin.php?action=delpost&amp;id=' . $rows['id']  . '">Delete</a></td>';
			echo '</tr>';
		}
		echo '</table></div></div>
		<div class="paginate">';
		if($page > 1)
		{
			$prev = ($page - 1);
			echo '<a href="?action=posts&amp;page=' . $prev . '" style="margin-right:20px">&laquo; Previous</a>';
		}
		if($page < $total_pages)
		{
			$next = ($page + 1);
			echo '<a href="?action=posts&amp;page=' . $next . '">Next &raquo;</a>';
		}
		echo '</div>';
	} else {
		echo "<div class='ntitle'><span style='font-weight:bold'>No Posts</span></div>";
		echo '<div class="content"><div style="padding:5px">No posts were found.</div></div>';
	}
} else {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Access Denied</span></div>
	<div class='content'><div style='padding:5px'>You are not authorized to enter the admin panel.</div></div>";
}
?>