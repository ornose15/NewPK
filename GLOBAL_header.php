<div class="hwrap">
	Welcome to the home of Pk
    <?php
	if(loggedIn()) {
		$tresult = mysql_query("SELECT * FROM newpk_users WHERE name='" . getUser() . "'") or die("Query failed with error: ".mysql_error());
		$trows = mysql_fetch_array($tresult);
    	echo '<span style="float:right; font-weight:normal;">Logged in as <a href="do.php?action=profile&amp;id=' . $trows['id'] . '">'. getUser() . '</a></span>';
	} else {
		echo '<span style="float:right; font-weight:normal;">You are not logged in. <a href="http://blog.pyrokid.com/do.php?action=login">Log in</a> | <a href="http://blog.pyrokid.com/do.php?action=register">Register</a></span>';
	}
	?>
</div>