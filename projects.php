<?php
require_once('CONF_mysql.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Pyrosite - Projects</title>
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
		<div class='ntitle'><span style='font-weight:bold'>Projects</span></div>
		<div class='content'><div style='padding:5px'>
        	<div class="com_box cmtitle">Websites</div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/Pk.png" height="70" width="70" alt="Pyrosite" /></div>
                <div class="left under">Pyrosite</div>
                <div class="left extended">My personal website. You are here.</div>
                <div style="clear:both"></div>
			</div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/pksef.png" height="70" width="70" alt="Super Epic Freeroam" /> <img src="images/projicons/pklts.png" height="70" width="70" alt="Last Team Standing" /></div>
                <div class="left under" style="width:79%;">Pyrokid's Super Epic Freeroam / Last Team Standing</div>
                <div class="left">
                	The website for my IV: Multiplayer IV:MP modes, Super Epic Freeroam and Last Team Standing.
                  	<ul class="sidebar">
                    	<li><a href="http://pksef.pyrokid.com">PkSEF Website</a></li>
                        <li><a href="http://pklts.pyrokid.com">PkLTS Website</a></li>
                    </ul>
                </div>
                <div style="clear:both"></div>
            </div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/ppaste.png" height="70" width="70" alt="PyroPaste" /></div>
                <div class="left under">PyroPaste</div>
                <div class="left extended">
                	Paste and share code to debug it with whomever may be helping you.
                  	<ul class="sidebar">
                    	<li><a href="http://pyropaste.com">Website</a></li>
                    </ul>
                </div>
                <div style="clear:both"></div>
            </div>
            
            <div class="com_box cmtitle">Game Servers</div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/pksef.png" height="70" width="70" alt="Super Epic Freeroam" /></div>
                <div class="left under">Pyrokid's Super Epic Freeroam</div>
                <div class="left extended">
                	A fun and original freeeroam server with many commands, stunting, car spawning, deathmatching and racing. The world is open, do whatever you want!<br />
					IP: pk.pyropaste.com:9999
                  	<ul class="sidebar">
                    	<li><a href="http://blog.pyrokid.com">Website</a></li>
                    </ul>
                </div>
                <div style="clear:both"></div>
            </div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/pklts.png" height="70" width="70" alt="Last Team Standing" /></div>
                <div class="left under">Pyrokid's Last Team Standing</div>
                <div class="left extended">
                	An game mode for IV:MP that will be of the team deathmatch persuasion. Teams will fight to eliminate their opponents in a wide array of small to large arenas and weapons.<br />
					IP: pk.pyropaste.com:9998
                  	<ul class="sidebar">
                    	<li><a href="http://blog.pyrokid.com">Website</a></li>
                    </ul>
                </div>
                <div style="clear:both"></div>
            </div>
            
            <div class="com_box cmtitle">Affiliations</div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/ivmp.png" height="70" width="70" alt="IV: Multiplayer" /></div>
                <div class="left under">IV: Multiplayer</div>
                <div class="left extended">
                	IV: Multiplayer let's you create you're own multiplayer game modes in GTA IV.
                  	<ul class="sidebar">
                    	<li><a href="http://iv-multiplayer.com">Website</a></li>
                    </ul>
                </div>
                <div style="clear:both"></div>
            </div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/noicon.png" height="70" width="70" alt="IRC.sc" /></div>
                <div class="left under">IRC.sc</div>
                <div class="left extended">
					IRC.sc is a fairly new IRC network for people belonging in the kool kidz klub. Everyone can join up and chat with us.
                  	<ul class="sidebar">
                    	<!--li><a href="http://androidirc.org">Website</a></li-->
                        <li><a href="irc://irc.sc/android">Direct connect to the network</a></li>
                    </ul>
				</div>
                <div style="clear:both"></div>
            </div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/negro.png" height="70" width="70" alt="NServer" /></div>
                <div class="left under">NServer</div>
                <div class="left extended">
                	A gaming community which focuses mainly on Steam games. It is not a clan but members do get special promotions and awards from time to time.
                	<ul class="sidebar">
                    	<li><a href="http://negroserver.com">Website</a></li>
                    </ul>
                </div>
                <div style="clear:both"></div>
            </div>
            
            <div class="com_box cmtitle">Others</div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/noicon.png" height="70" width="70" alt="No icon" /></div>
                <div class="left under">Web Design</div>
                <div class="left extended">
                	On my spare time I design and code websites for people. You can see some on the <a href="gallery.php">Gallery</a> page.
                </div>
                <div style="clear:both"></div>
            </div>
			<div class="com_box">
            	<div class="left icon"><img src="images/projicons/noicon.png" height="70" width="70" alt="No icon" /></div>
                <div class="left under">Pyrobot</div>
                <div class="left extended">
                	An IRC bot which I work on. It is being developed for my own personal use and knowledge. There will never be a release. Sorry.
                </div>
                <div style="clear:both"></div>
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