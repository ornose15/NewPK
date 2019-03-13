<?php
$form_title = "
<div class='ntitle'><span style='font-weight:bold'>Register</span></div>
	<div class='content'><div style='padding:5px'>
";
require_once('recaptchalib.php');
$publickey = "6LeYKcYSAAAAANPYLCZEiIEeBLdOvsUYW3E5Weqq";
$form_content_form = "
	<form action='do.php?action=register' method='post'>
		<div><input type='text' name='email' size='30' class='input' /> E-mail</div>
		<div><input type='text' name='name' size='30' maxlength='20' class='input' /> Name</div>
		<div><input type='password' name='pass' size='30' maxlength='50' class='input'  /> Password</div>
		<div>" . recaptcha_get_html($publickey) . "</div>
		<div><input type='submit' value='Register' /></div>
	</form>
	</div>
</div>";
$form_content_success = "
<div class='ntitle'><span style='font-weight:bold'>Register</span></div>
<div class='content'><div style='padding:5px'>Successfully registered and logged in. Welcome.</div></div>
<meta http-equiv=\"REFRESH\" content=\"2;url=index.php\">";

if(loggedIn()) {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Register</span></div>
	<div class='content'><div style='padding:5px'>You are logged in and cannot register.</div></div>";
} else {
	if(isset($_POST['email'], $_POST['name'], $_POST['pass'])) {
		$email = mysql_real_escape_string($_POST['email']);
		$name = cleanUser($_POST['name']);
		$pass = hash('whirlpool', $_POST['pass']);
		function registerUser($email, $name, $pass) {
			global $form_title, $form_content_form, $form_content_success;
			if(is_empty($email) || is_empty($name) || is_empty($pass))
			{
				echo $form_title . 'All fields are required.<br /><br />' . $form_content_form;
				return 1;
			}
			$exists = mysql_query("SELECT * FROM newpk_users WHERE LOWER(name)='".strtolower($name)."'");
			if(mysql_num_rows($exists) > 0) {
				echo $form_title . 'Account with this name already registered.<br /><br />' . $form_content_form;
				return 1;
			}
			$exists = mysql_query("SELECT * FROM newpk_users WHERE LOWER(email)='".strtolower($email)."'");
			if(mysql_num_rows($exists) > 0) {
				echo $form_title . 'Account with this e-mail address already registered.<br /><br />' . $form_content_form;
				return 1;
			}
			if(!strstr($email,"@") || !strstr($email,".")) {
				echo $form_title . 'Please enter a real e-mail address.<br /><br />' . $form_content_form;
				return 1;
			}
			require_once('recaptchalib.php');
			$privatekey = "6LeYKcYSAAAAAACpT5XVtQmz6o1o8Smnac-pfHV5";
			$resp = recaptcha_check_answer ($privatekey, $_SERVER["REMOTE_ADDR"], $_POST["recaptcha_challenge_field"], $_POST["recaptcha_response_field"]);
			if (!$resp->is_valid) {
				echo $form_title . "The reCAPTCHA wasn't entered correctly. Try again." . $form_content_form;
				return 1;
			}
			$time = time();
			mysql_query("INSERT INTO newpk_users (name, pass, email, register_date, posts, level, status) VALUES ('$name', '$pass', '$email', '$time', '0', '1', 'Active')") or die("Query failed with error: ".mysql_error());
			?>
			<script>
				<?php
				echo "var name = '" . $name . "';\n";
				echo "var pass = '" . $pass . "';\n";
				?>
				setCookie('pk_user', name, 30);
				setCookie('pk_pass', pass, 30);
				setCookie('pk_level', '1', 30);
			</script>
			<?php
			echo $form_content_success;
			return 1;
		}
		registerUser($email, $name, $pass);
	} else {
		echo $form_title . $form_content_form;
	}
}
?>