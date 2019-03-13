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
	$tot=mysql_query("SELECT * FROM newpk_comments");
	$total = mysql_num_rows($tot);
	if($total != 0)
	{
		$result = mysql_query("SELECT * FROM newpk_comments ORDER BY id DESC LIMIT $cur, $max") or die("Query failed with error: ".mysql_error());
		$total_pages = ceil($total / $max);
		echo "<div class='ntitle'><span style='font-weight:bold'>Comments</span></div>";
		echo '<div class="content"><div style="padding:5px">';
		echo '<table width="100%">';
		echo '<tr>
			<th>ID</th>
			<th>Post Title</th>
			<th>Comment Author</th>
			<th>Snippet</th>
			<th>Date Posted</th>
			<th>IP</th>
			<th>Action</th>
			</tr>
		';
		while($rows = mysql_fetch_array($result)) { //add comment snippet, remove returns (see pb2c)
			$text = str_replace(array("\r\n", "\r", "\n"), ' ', $rows['text']);
			$text = substr($text, 0, 30) . '...';
			echo '<tr>
				<td>' . $rows['id'] . '</td>
				<td><a href="' . $rows['post_safe'] . '#comments">' . $rows['post_title'] . '</a></td>
				<td>' . $rows['author'] . '</td>
				<td>' . $text . '</td>
				<td>' . date("M j, Y", $rows['date']) . '</td>
				<td>' . $rows['ip'] . '</td>
				<td><a href="admin.php?action=delcom&amp;comid=' . $rows['id']  . '">Delete</a> &#183; <a href="admin.php?action=banip&amp;ip=' . $rows['ip']  . '">Ban IP</a></td>';
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
		echo "<div class='ntitle'><span style='font-weight:bold'>No Comments</span></div>";
		echo '<div class="content"><div style="padding:5px">No comments were found.</div></div>';
	}
} else {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Access Denied</span></div>
	<div class='content'><div style='padding:5px'>You are not authorized to enter the admin panel.</div></div>";
}
?>