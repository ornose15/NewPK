<?php
require_once('CONF_mysql.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite - Bio</title>
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
		<div class='ntitle'><span style='font-weight:bold'>Bio - About Me</span></div>
		<div class='content'><div style='padding:5px'>
			<ul class="sidebar">
				<li>Name: Ornose</li>
				<li>Nicknames: Pyrokid, Pk, Tojo</li>
                <li>Location: Orlando, Florida, United States</li>
                <li>Languages: XHTML, PHP, MySQL, mIRC, Delphi, Javascript, Pawn, Squirrel</li>
                <li>Interests: Football, basketball, school, politics, scripting, coding, gaming, designing</li>
                <li>Photoshop user for: 9 years</li>
                <li>Web designer for: 3 years</li>
            </ul>
            <br />
			<ul class="sidebar">
				<li>Websites:
                	<ul class="sidebar">
                        <li><a href="index.php">Pyrosite - You are here</a></li>
                        <li><a href="http://pksef.pyrokid.com">Pyrokid's Super Epic Freeroam - The website for my IV:MP freeroam mode</a></li>
                        <li><a href="http://pyropaste.net">PyroPaste - Paste and share code</a></li>
                        <li><a href="projects.php">Learn more in the Projects page...</a></li>
            		</ul>
            	</li>
            </ul>
            <br />
			<ul class="sidebar">
				<li><a href="contact.php">Contact me</a></li>
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