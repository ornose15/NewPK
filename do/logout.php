<?php
if(loggedIn()) {
?>
<script>
	setCookie('pk_user', 'del', 0);
	setCookie('pk_pass', 'del', 0);
	setCookie('pk_level', 'del', 0);
</script>
<?php
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Log Out</span></div>
	<div class='content'><div style='padding:5px'>You have successfully logged out.<br />You are being redirected.</div></div>
	<meta http-equiv='REFRESH' content='2;url=index.php'>";
} else {
	echo "
	<div class='ntitle'><span style='font-weight:bold'>Log Out</span></div>
	<div class='content'><div style='padding:5px'>You are not logged in. <a href='do.php?action=login'>Do you want to log in?</a></div></div>";
}
?>