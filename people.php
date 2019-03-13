<?php
require_once('CONF_mysql.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite - People</title>
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
		<div class='ntitle'><span style='font-weight:bold'>People</span></div>
		<div class='content'><div style='padding:5px'>
            These people are leet. Thanks for not sucking.<br /><br />
			<?php
            $peeps = array(
                'NegroCollegeFund', 'McFool', 'MaVe', 'Matthias', 'RBOMB', 'woot', 'IJzerenRita', 'Westie', 'PwnFlakes', 'Jamie', 'Lon', 'Boylett', 'Cameron', 'MrX', 'Sebihunter', 'TrojaA', 'Jenksta', 'Doug', 'bpeterson',
				'Christian', 'Felle', 'Pandabeer1337', 'PBomb', 'whooper', 'SE7EN', 'PwnFlakes', 'JaTochNietDan', 'Peter', 'Luke', 'Simon', 'AdTec_224',
				'VecettiG', 'Jason_Voorhees', '<strong>Everyone from the Cherry Poppers clan</strong>'
            );
            ?>
            <ul class="sidebar">
                <?php
				foreach($peeps as $name) {
					echo '<li>' . $name . '</li>';
				}
				?>
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