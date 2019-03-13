<?php
$form_title = "
<div class='ntitle'><span style='font-weight:bold'>Log In</span></div>
	<div class='content'><div style='padding:5px'>
";
$form_content_form = "
	<form action='do.php?action=login' method='post'>
		<div><input type='text' name='name' size='30' maxlength='20' class='input' /> Name</div>
		<div><input type='password' name='pass' size='30' maxlength='50' class='input'  /> Password</div>
		<div><input type='submit' value='Log In' /></div>
	</form>
	</div>
</div>";
$form_content_success = "
<div class='ntitle'><span style='font-weight:bold'>Log In</span></div>
<div class='content'><div style='padding:5px'>Successfully logged in. Welcome back.<br />You are being redirected.</div></div>";

if(loggedIn()) {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Log In</span></div>
	<div class='content'><div style='padding:5px'>You are already logged in. <a href='do.php?action=logout'>Do you want to log out?</a></div></div>";
} else {
	if(isset($_POST['name'], $_POST['pass'])) {
		$name = cleanUser($_POST['name']);
		$pass = hash('whirlpool', $_POST['pass']);
		function loginUser($name, $pass) {
			global $form_title, $form_content_form, $form_content_success;
			if(is_empty($name) || is_empty($pass))
			{
				echo $form_title . 'Both fields are required.<br /><br />' . $form_content_form;
				return 1;
			}
			$exists = mysql_query("SELECT * FROM newpk_users WHERE (LOWER(name)='".strtolower($name)."')");
			if(mysql_num_rows($exists) < 1) {
				echo $form_title . 'Account does not exist. <a href="do.php?action=register">Would you like to register an account?</a><br /><br />' . $form_content_form;
				return 1;
			}
			$exists = mysql_query("SELECT * FROM newpk_users WHERE (LOWER(name)='".strtolower($name)."') AND (pass='$pass')");
			if(mysql_num_rows($exists) < 1) {
				echo $form_title . 'Incorrect username or password.<br /><br />' . $form_content_form;
				return 1;
			}
			$rows = mysql_fetch_array($exists);
			?>
			<script>
				<?php
				echo "var name = '" . $rows['name'] . "';\n";
				echo "var pass = '" . $rows['pass'] . "';\n";
				echo "var level = '" . $rows['level'] . "';\n";
				?>
				setCookie('pk_user', name, 30);
				setCookie('pk_pass', pass, 30);
				setCookie('pk_level', level, 30);
			</script>
			<?php
			echo $form_content_success . '
			<meta http-equiv="REFRESH" content="2;url=index.php">';
			return 1;
		}
		loginUser($name, $pass);
	} else {
		echo $form_title . $form_content_form;
	}
}
?>