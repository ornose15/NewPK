<?php
require_once('CONF_mysql.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite - Contact</title>
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
		<div class='ntitle'><span style='font-weight:bold'>Contact</span></div>
		<div class='content'><div style='padding:5px'>
            You can find me on IRC.sc as either Pyrokid or Tojo.
			<ul class="sidebar">
				<li><a href="irc://irc.sc/android">Direct connect to the network</a></li>
			</ul>
			You can also find me on..
			<ul class="sidebar">
				<li><a href="https://plus.google.com/101881380200766730117/posts">Google+</a></li>
				<li><a href="http://steamcommunity.com/id/Pyrokid">Steam</a></li>
			</ul>
			Places you won't ever find me..
			<ul class="sidebar">
				<li><a href="http://xfire.com/profile/cartermcpyro">Xfire (never online)</a></li>
				<li>Live Messenger (never ever online)</li>
			</ul>
        </div></div>
    </div>
	
	<div class="sideboxes">
		<?php require_once('GLOBAL_sideboxes.php'); ?>
	</div>
	
	<div class="copyright">Design and content copyright &copy; <?php date_default_timezone_set("America/New_York"); echo date("Y"); ?> Pyrokid.</div>
</div>

</body>

</html>