<?php
require_once('CONF_mysql.php');
setLatest();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite</title>
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
		$tot=mysql_query("SELECT * FROM newpk");
		$total = mysql_num_rows($tot);
		if($total != 0)
		{
			$result = mysql_query("SELECT * FROM newpk ORDER BY id DESC LIMIT $cur, $max") or die("Query failed with error: ".mysql_error());
			$total_pages = ceil($total / $max);
			while($rows = mysql_fetch_array($result))
			{
				$totc=mysql_query("SELECT * FROM newpk_comments WHERE `post-id`='".$rows['id']."'");
				$total_comments = mysql_num_rows($totc);
				echo "<div class='ntitle' id='".$rows['safe-title']."'><span style='font-weight:bold'><a href='".$rows['safe-title']."'>".$rows['title']."</a></span> by " .$rows['author']." on " . date("M j, Y", $rows['date']); if(getLevel() >= 3) { echo ' &#183; <a href="admin.php?action=editpost&amp;id=' . $rows['id']  . '">Edit</a> &#183; <a href="admin.php?action=newpost">New</a>'; } echo "</div>";
				echo '<div class="content"><div style="padding:5px">' . nl2br(stripslashes($rows['text'])) . '</div>';
				if($rows['open'] == 'yes') {
					echo "<div class='comments'><a href='".$rows['safe-title']."#comments'>" . $total_comments . " comments <img src='./images/comment.jpg' height='12' width='14' alt='' /></a></div>";
				} else {
					echo "<div class='comments'><a href='".$rows['safe-title']."#comments'>Comments closed <img src='./images/comment.jpg' height='12' width='14' alt='' /></a></div>";
				}
				echo '</div>';
			}
			echo '<div class="paginate">';
			if($page < $total_pages)
			{
				$next = ($page + 1);
				echo '<a href="?page=' . $next . '" style="margin-right:20px">&laquo; Older Posts</a>';
			}
			if($page > 1)
			{
				$prev = ($page - 1);
				echo '<a href="?page=' . $prev . '">Newer Posts &raquo;</a>';
			}
			echo '</div>';
		} else {
			echo "<div class='ntitle'><span style='font-weight:bold'>No Posts</span></div>";
			echo '<div class="content"><div style="padding:5px">There\'s no posts</div></div>';	
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