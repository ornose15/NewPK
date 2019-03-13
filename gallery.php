<?php
require_once('CONF_mysql.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite - Gallery</title>
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
		<div class='ntitle'><span style='font-weight:bold'>Gallery</span></div>
		<div class='content'><div style='padding:5px'>
        	Welcome to the gallery of Pyrokid. Everything is sorted from newer to older.
			<div class="com_box cmtitle">Website Designs</div>
			<div class="com_box">
				<ul class="sidebar">
					<li><a href="http://pyrokid.dyndns.org/atemp3">Template #3</a></li>
					<li><a href="http://pyrokid.dyndns.org/atemp2">Template #2</a></li>
					<li><a href="http://pyrokid.dyndns.org/atemp1">Template #1</a></li>
					<li><a href="http://pyrokid.dyndns.org/atemp0">Template #0</a></li>
					<li><a href="http://pyrokid.dyndns.org/mavedev">mavedev</a></li>
					<li><a href="http://cameronbanfield.co.uk">Cameron Banfield</a></li>
					<li><a href="http://domvps.com">domVPS</a></li>
					<li><a href="http://iv-multiplayer.com">IV: Multiplayer</a></li>
					<li><a href="http://pyrokid.dyndns.org/v0x">v0x.org</a></li>
					<li><a href="http://pyrokid.dyndns.org/niv">Networked: IV</a></li>
					<li><a href="index.php">Pyrosite</a></li>
					<li><a href="http://androidirc.org">AndroidIRC</a></li>
					<li><a href="http://negroserver.com">NServer</a></li>
 					<li><a href="http://pyrokid.dyndns.org/xhost">X-Host</a></li>
					<li><a href="http://pyrokid.dyndns.org/mave">Mavecoder</a></li>
					<li><a href="http://pksef.pyrokid.com">PkSEF</a></li>
					<li><a href="http://iv-freeroam.com">IV-Freeroam (except banner)</a></li>
				</ul>
			</div>
			<div class="com_box cmtitle">Signatures</div>
			<div class="com_box">
				<ul style="list-style-type:none; padding-left:5px;">
					<li><img height="120" width="330" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/Crysis.jpg" /></li>
					<li><img height="120" width="330" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/DeadSpace.jpg" /></li>
					<li><img height="120" width="320" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/Eddie.jpg" /></li>
					<li><img height="120" width="320" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/MasterChief.jpg" /></li>
					<li><img height="120" width="350" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/SpaceMarine.jpg" /></li>
					<li><img height="120" width="350" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/Spawn.jpg" /></li>
					<li><img height="120" width="350" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/TF2Grunge.jpg" /></li>
					<li><img height="110" width="400" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/HL2Pyro.jpg" /></li>
					<li><img height="100" width="400" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/AbstractGrunge.gif" /></li>
					<li><img height="152" width="346" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/Cross.jpg" /></li>
					<li><img height="99" width="361" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/Archer.jpg" /></li>
					<li><img height="152" width="402" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/HorseMan.jpg" /></li>
					<li><img height="103" width="363" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/LeaugeOfStrongMen.jpg" /></li>
					<li><img height="97" width="357" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/MotionCar.jpg" /></li>
					<li><img height="101" width="356" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/SCsig.jpg" /></li>
					<li><img height="129" width="404" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/Stingerssig.jpg" /></li>
					<li><img height="148" width="347" alt="" src="http://i11.photobucket.com/albums/a191/cartermcpyro/Vice.jpg" /></li>
				</ul>
			</div>
        </div></div>
    </div>
	
	<div class="sideboxes">
		<?php require_once('GLOBAL_sideboxes.php'); ?>
	</div>
	
	<div class="copyright">Design and content copyright &copy; <?php date_default_timezone_set("America/New_York"); echo date("Y"); ?> Pyrokid.</div>
</div>

</body>

</html>