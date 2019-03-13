<div class="sidebox">
	<div class="stitle">Latest Posts</div>
	<div class="scontent">
		<ul class="sidebar">
			<?php
			$tot=mysql_query("SELECT * FROM newpk");
			$total = mysql_num_rows($tot);
			if($total != 0) {
				$result = mysql_query("SELECT * FROM newpk ORDER BY id DESC LIMIT 5") or die("Query failed with error: ".mysql_error());
				while($rows = mysql_fetch_array($result)) {
					echo '<li><a href="index.php#'.$rows['safe-title'].'">' . $rows['title'] . '</a></li>';
				}
			} else {
				echo '<li>No Posts</li>';	
			}
			?>
		</ul>
	</div>
</div>

<div class="sidebox">
	<div class="stitle">Link Roll</div>
	<div class="scontent">
		<ul class="sidebar">
			<li><a href="http://pyropaste.net">PyroPaste</a></li>
			<li><a href="http://iv-m.com">IV:MP</a></li>
			<!--li><a href="http://androidirc.org">AndroidIRC</a></li-->
			<li><a href="http://mavedev.com">mavedev</a></li>
            <li><a href="http://matthias.van-eeghem.com/">Matthias' Blog</a></li>
			<li><a href="http://negroserver.com">NServer</a></li>
			<li><a href="http://no1servers.com">No1Servers</a></li>
		</ul>
	</div>
</div>

<div class="sidebox">
	<div class="stitle">Meta</div>
	<div class="scontent">
		<ul class="sidebar">
			<li><a href="http://validator.w3.org/check?uri=referer">XHTML</a></li>
			<li><a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a></li>
			<li><a href="members.php">Members</a></li>
			<?php
			if(!loggedIn()) {
				echo '<li><a href="do.php?action=register">Register</a></li>
				<li><a href="do.php?action=login">Log in</a></li>';
			} else {
				echo '<li><a href="do.php?action=logout">Log out</a></li>';
				if(getLevel() == 2) {
					echo '<li><a href="admin.php">Mod Panel</a></li>';
				} else if(getLevel() >= 3) {
					echo '<li><a href="admin.php">Admin Panel</a></li>';
				}
			}
			?>
		</ul>
	</div>
</div>

<div class="sidebox">
	<div class="stitle"><a href="http://www.last.fm/user/pyrokid">Last.fm</a></div>
	<div class="scontent lastfm">
	<?php
	$i = 1;
	$doc = new DOMDocument();
	$doc->load('http://ws.audioscrobbler.com/1.0/user/pyrokid/recenttracks.rss');
	echo '<ul class="sidebar">';
	foreach($doc->getElementsByTagName('item') as $node) {
		if ($i % 2 != 0) {
			$class = "class='alt1'";
		} else {
			$class = "class='alt2'";
		}
		echo "<li $class>" . htmlspecialchars($node->getElementsByTagName('title')->item(0)->nodeValue) . '<br /><span>' .
		str_replace(' +0000', '', $node->getElementsByTagName('pubDate')->item(0)->nodeValue) . '</span></li>';
		$i++;
	}
	echo '</ul>';
	?>
	</div>
</div>

<div class="sidebox">
	<div class="stitle">Twitter</div>
	<div class="scontent twitter">
		<script src="http://widgets.twimg.com/j/2/widget.js" type="text/javascript"></script>
        <script type="text/javascript">
        new TWTR.Widget({
          version: 2,
          type: 'profile',
          rpp: 5,
          interval: 6000,
          width: 'auto',
          height: 300,
          theme: {
            shell: {
              background: '#ffffff',
              color: '#000000'
            },
            tweets: {
              background: '#ffffff',
              color: '#000000',
              links: '#555555'
            }
          },
          features: {
            scrollbar: false,
            loop: false,
            live: false,
            hashtags: true,
            timestamp: true,
            avatars: false,
            behavior: 'all'
          }
        }).render().setUser('Apple').start();
        </script>
	</div>
</div>