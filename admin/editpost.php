<?php
if(loggedIn() && getLevel() >= 3) {	
	function editPost() {
		$res = '';
		if(isset($_GET['id'])) {
			$id = mysql_real_escape_string($_GET['id']);
		} else {
			$id = -1;
		}
		if(isset($_POST['text'], $_POST['title'])) {
			$text = addslashes($_POST['text']);
			$title = $_POST['title'];
			$safe_title = cleanTitle($_POST['title']);
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
				mysql_query("UPDATE newpk SET title='$title', `safe-title`='$safe_title', text='$text', open='$open' WHERE id='$id'");
				$comments = mysql_query("SELECT * FROM newpk WHERE id='".$id."'");
				$row = mysql_fetch_array($comments);
				echo "
				<div class='ntitle'><span style='font-weight:bold'>Edit Post - ". $row['title'] . "</span></div>
				<div class='content'><div style='padding:5px'>Post successfully updated. You are being redirected.</div></div>";
				setLatest();
				echo "<meta http-equiv='REFRESH' content='2;url=admin.php?action=editpost&amp;id=$id'>";
				return 1;
			} else {
				$res = 'All fields required.<br /><br />';
			}
		}
		$comments = mysql_query("SELECT * FROM newpk WHERE id='".$id."'");
		$row = mysql_fetch_array($comments);
		if($res != 'success') {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Edit Post - ". $row['title'] . "</span></div>
			<div class='content'><div style='padding:5px'>" . $res . "
				<form action='admin.php?action=editpost&amp;id=$id' method='post'>
				<div><input type='text' name='title' value='" . $row['title'] . "' class='input' size='33' /> Title</div>
				<div><textarea name='text' rows='20' cols='90' class='input'>" . $row['text'] . "</textarea></div>
			";
			if($row['open'] == 'yes') {
				echo "<div><input type='checkbox' name='open' value='yes' checked='checked' /> Open for comments</div>";
			} else {
				echo "<div><input type='checkbox' name='open' value='yes' /> Open for comments</div>";
			}
			echo "
				<div><input type='submit' value='Update' /> <input type='reset' value='Undo' /></div>
				</form>
			</div></div>";
		}
		return 1;
	}
	editPost();
} else {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Access Denied</span></div>
	<div class='content'><div style='padding:5px'>You are not authorized to enter the admin panel.</div></div>";
}
?>