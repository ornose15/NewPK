<?php
if (!isset($_SESSION)) {
	session_start();
}
require_once('CONF_mysql.php');
$id = mysql_real_escape_string($_GET['sid']);
$result=mysql_query("SELECT * FROM newpk WHERE `safe-title`='$id'") or die("Query failed with error: ".mysql_error());
$rows = mysql_fetch_array($result);
if(isset($_GET['page']))
{
	$page = mysql_real_escape_string($_GET['page']);
} else {
	$page = 1;
}
$max = 20;
$cur = (($page * $max) - $max);

$error = '';
if(isset($_POST['name'], $_POST['text'], $_POST['post'])) {
	$name = cleanUser($_POST['name']);
	$text = addslashes($_POST['text']);
	$postid = $_POST['post'];
	$post_title = $_POST['post_title'];
	$post_safe = $_POST['post_safe'];
	if(!is_empty($name) && !is_empty($text)) {
		require_once('recaptchalib.php');
		$privatekey = "6LeYKcYSAAAAAACpT5XVtQmz6o1o8Smnac-pfHV5";
		$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
		if (!$resp->is_valid) {
			$error = "The reCAPTCHA wasn't entered correctly. Try again.<br /><br />";
		} else {
			if(isset($_SESSION['antiflood']) && $_SESSION['antiflood'] > time() - 10){
				header("location: /flood.php");
				exit;
			}
			$_SESSION['antiflood'] = time();
			$date = time();
			$ip = $_SERVER['REMOTE_ADDR'];
			mysql_query("INSERT INTO newpk_comments (`post-id`, post_title, post_safe, author, text, date, ip) VALUES ('$postid', '$post_title', '$post_safe', '$name', '$text', '$date', '$ip')");
			if(loggedIn()) {
				mysql_query("UPDATE newpk_users SET posts=posts+1 WHERE name='" . getUser() . "'");
			}
		}
	} else {
		$error = 'Both fields required<br /><br />';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite - <?php echo $rows['title']; ?></title>
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
		function replaceSmilies($str, $smilies) {
		   $new_str = $str;
		   foreach($smilies as $tag => $image) {
			 $new_str = str_ireplace($tag, $image, $new_str);
		   }
		   return $new_str; //return the new, updated string containing the smiley images
		}
		if(mysql_num_rows($result) < 1) {
			echo "
			<div class='ntitle'><span style='font-weight:bold'>Post Not Found</span></div>
			<div class='content'><div style='padding:5px'>The post you requested was not found.</div></div>";
		} else {
			$total=mysql_query("SELECT * FROM newpk_comments WHERE `post-id`='".$rows['id']."'");
			$total_comments = mysql_num_rows($total);
			$total_pages = ceil($total_comments / $max);
			echo "<div class='ntitle' id='".$rows['safe-title']."'><span style='font-weight:bold'>".$rows['title']."</span> by " .$rows['author']." on " . date("M j, Y", $rows['date']); if(getLevel() >= 3) { echo ' &#183; <a href="admin.php?action=editpost&amp;id=' . $rows['id']  . '">Edit</a> &#183; <a href="admin.php?action=newpost">New</a>'; } echo "</div>";
			echo '<div class="content"><div style="padding:5px">' . nl2br(stripslashes($rows['text'])) . '</div>';
			echo '</div>';
			
			$banned = mysql_query("SELECT * FROM newpk_bans WHERE ip='" . $_SERVER['REMOTE_ADDR'] . "'");
			if(mysql_num_rows($banned) > 0) {
				echo "<div class='ntitle'><span style='font-weight:bold'>Banned</span></div>";
				echo '<div class="content"><div style="padding:5px">You are banned and cannot post comments.</div></div>';	
			} else {
			if($rows['open'] == 'yes') {
				global $error;
				echo "<div class='ntitle' style='margin-bottom:5px;' id='comments'><span style='font-weight:bold'>" . $total_comments . " Comment(s)</span></div>";
					echo '<div class="content"><div style="padding:5px;">' . $error;
						$comments = mysql_query("SELECT * FROM newpk_comments WHERE `post-id`='".$rows['id']."' ORDER BY id DESC LIMIT $cur, $max");
						$crow = mysql_query("SELECT * FROM newpk_comments WHERE `post-id`='".$rows['id']."'");
						$rowz = mysql_fetch_array($crow);
						if(loggedIn()) {
							require_once('recaptchalib.php');
							$publickey = "6LeYKcYSAAAAANPYLCZEiIEeBLdOvsUYW3E5Weqq";
							echo "<form action='".$rows['safe-title']."#comments' method='post'>
							<div><input type='text' name='name' size='30' maxlength='20' class='input' readonly='readonly' value='". getUser() ."' /> Name</div>
							<div><textarea name='text' rows='5' cols='40' class='input' id='com_inp'></textarea></div>
							<div>" . recaptcha_get_html($publickey) . "</div>
							<div><input type='hidden' name='post' value='".$rows['id']."' /></div>
							<div><input type='hidden' name='post_title' value='".$rows['title']."' /></div>
							<div><input type='hidden' name='post_safe' value='".$rows['safe-title']."' /></div>
							<div><input type='submit' value='Comment' /> <input type='reset' value='Clear' /></div>
							</form>";
						} else {
							require_once('recaptchalib.php');
							$publickey = "6LeYKcYSAAAAANPYLCZEiIEeBLdOvsUYW3E5Weqq";
							echo "<form action='".$rows['safe-title']."#comments' method='post'>
							<div><input type='text' name='name' size='30' maxlength='20' class='input' /> Name</div>
							<div><textarea name='text' rows='5' cols='40' class='input' id='com_inp'></textarea></div>
							<div>" . recaptcha_get_html($publickey) . "</div>
							<div><input type='hidden' name='post' value='".$rows['id']."' /></div>
							<div><input type='hidden' name='post_title' value='".$rows['title']."' /></div>
							<div><input type='hidden' name='post_safe' value='".$rows['safe-title']."' /></div>
							<div><input type='submit' value='Comment' /> <input type='reset' value='Clear' /></div>
							</form>";
						}
						$smilies = array(
							':S' => '<img src="images/emotes/confused.gif" alt="" />',
							'B-)' => '<img src="images/emotes/cool.gif" alt="" />',
							'B)' => '<img src="images/emotes/cool.gif" alt="" />',
							'8-)' => '<img src="images/emotes/cool.gif" alt="" />',
							'8)' => '<img src="images/emotes/cool.gif" alt="" />',
							':\'(' => '<img src="images/emotes/crying.gif" alt="" />',
							':D' => '<img src="images/emotes/grin.gif" alt="" />',
							'>:(' => '<img src="images/emotes/mad.gif" alt="" />',
							':O' => '<img src="images/emotes/omg.gif" alt="" />',
							':-O' => '<img src="images/emotes/omg.gif" alt="" />',
							':o' => '<img src="images/emotes/omg.gif" alt="" />',
							':-o' => '<img src="images/emotes/omg.gif" alt="" />',
							':(' => '<img src="images/emotes/sad.gif" alt="" />',
							':-(' => '<img src="images/emotes/sad.gif" alt="" />',
							':)' => '<img src="images/emotes/smile.gif" alt="" />',
							':-)' => '<img src="images/emotes/smile.gif" alt="" />',
							':|' => '<img src="images/emotes/stare.gif" alt="" />',
							':-|' => '<img src="images/emotes/stare.gif" alt="" />',
							':P' => '<img src="images/emotes/tongue.gif" alt="" />',
							':-P' => '<img src="images/emotes/tongue.gif" alt="" />',
							';)' => '<img src="images/emotes/wink.gif" alt="" />',
							';-)' => '<img src="images/emotes/wink.gif" alt="" />'
						);
						if((loggedIn() && getLevel() >= 2) || ($_SERVER['REMOTE_ADDR'] == $rowz['ip'])) {
							while($row = mysql_fetch_array($comments)) {
								echo '<div class="com_box">';
								echo '<span class="com_title" onclick="document.getElementById(\'com_inp\').value+=\'@' . $row['author'] . ' \'; document.getElementById(\'com_inp\').focus(); document.getElementById(\'com_inp\').value = document.getElementById(\'com_inp\').value; document.getElementById(\'com_inp\').selectionStart = document.getElementById(\'com_inp\').value.length; document.getElementById(\'com_inp\').selectionEnd = document.getElementById(\'com_inp\').value.length;">' . $row['author'] . '</span> on ' . date("M j, Y", $row['date']) . ' &#183; <a href="do.php?action=delcom&amp;comid='.$row['id'].'">Delete</a>';
								if(getLevel() >= 2) { echo ' &#183; <a href="admin.php?action=banip&amp;ip=' . $row['ip']  . '">Ban IP</a>'; }
								echo '<br /><br />';
								$text = nl2br(htmlspecialchars($row['text']));
								$text = replaceSmilies($text, $smilies);	
								echo $text;
								echo '</div>';
							}
						} else {
							while($row = mysql_fetch_array($comments)) {
								echo '<div class="com_box">';
								echo '<span class="com_title" onclick="document.getElementById(\'com_inp\').value+=\'@' . $row['author'] . ' \'; document.getElementById(\'com_inp\').focus(); document.getElementById(\'com_inp\').value = document.getElementById(\'com_inp\').value; document.getElementById(\'com_inp\').selectionStart = document.getElementById(\'com_inp\').value.length; document.getElementById(\'com_inp\').selectionEnd = document.getElementById(\'com_inp\').value.length;">' . $row['author'] . '</span> on ' . date("M j, Y", $row['date']) . '<br /><br />';
								$text = nl2br(htmlspecialchars($row['text']));
								$text = replaceSmilies($text, $smilies);
								echo $text;
								echo '</div>';
							}
						}
						echo '<div class="paginate">';
						if($page < $total_pages)
						{
							$next = ($page + 1);
							echo '<a href="'.$id.'&amp;page=' . $next . '#comments" style="margin-right:20px">&laquo; Older Comments</a>';
						}
						if($page > 1)
						{
							$prev = ($page - 1);
							echo '<a href="'.$id.'&amp;page=' . $prev . '#comments">Newer Comments &raquo;</a>';
						}
						echo '</div>
					</div>
				</div>';
			} else {
				echo "<div class='ntitle'><span style='font-weight:bold'>Comments Closed</span></div>";
				echo '<div class="content"><div style="padding:5px">Comments have been closed for this post.</div></div>';	
			}
			}
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