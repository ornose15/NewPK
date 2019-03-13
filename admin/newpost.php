<?php
if(loggedIn() && getLevel() >= 3) {	
	function newPost() {
		$res = '';
		if(isset($_POST['text'], $_POST['title'])) {
			$text = addslashes($_POST['text']);
			$title = $_POST['title'];
			$safe_title = cleanTitle($_POST['title']);
			$user = getUser();
			$newdate = time();
			$open = '';
			if(isset($_POST['open'])) { $open = $_POST['open']; }
			if(!is_empty($open)) {
				switch($open) {
					case 'yes':
						$open = 'yes';
						break;
					default:
						$open = 'no';
						break;
				}
			}
			if(!is_empty($text) && !is_empty($title)) {
				mysql_query("INSERT INTO newpk (title, `safe-title`, author, date, text, open) VALUES ('$title', '$safe_title', '$user', '$newdate', '$text', '$open')") or die("Query failed with error: ".mysql_error());
				mysql_query("UPDATE newpk_users SET posts=posts+1 WHERE name='" . getUser() . "'");
				$comments = mysql_query("SELECT * FROM newpk WHERE title='$title'");
				$row = mysql_fetch_array($comments);
				echo "
				<div class='ntitle'><span style='font-weight:bold'>New Post - ". $row['title'] . "</span></div>
				<div class='content'><div style='padding:5px'>Post successfully created. You are being redirected.</div></div>";
				setLatest();
				echo "<meta http-equiv='REFRESH' content='2;url=index.php'>";
				return 1;
			} else {
				$res = 'All fields required.<br /><br />';
			}
		}
		if($res != 'success') {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>New Post</span></div>
			<div class='content'><div style='padding:5px'>" . $res . "
				<form action='admin.php?action=newpost' method='post'>
				<div><input type='text' name='title' class='input' size='33' /> Title</div>
				<div><input type='text' name='author' value='" . getUser() . "' class='input' size='33' readonly='readonly' /> Author</div>
				<div><textarea name='text' rows='20' cols='120' class='input'></textarea></div>
				<div><input type='checkbox' name='open' value='yes' checked='checked' /> Open for comments</div>
				<div><input type='submit' value='Post' /> <input type='reset' value='Undo' /></div>
				</form>
			</div></div>";
		}
		return 1;
	}
	newPost();
} else {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Access Denied</span></div>
	<div class='content'><div style='padding:5px'>You are not authorized to enter the admin panel.</div></div>";
}
?>