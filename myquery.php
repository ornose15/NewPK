<?php
if(isset($_POST['key'], $_POST['query'])) {
	function myQuery($str, $key) {
		require_once('CONF_mysql.php');
		if($key == '8b099b12196af518eee9fe15bb9652de3e97e353618597f63908c20b71b67e7cef03e955c8c71f55ea06e46116dea3ec11cf7fa0f6876a56b1acf87efd2c5cb5')
		{
			if(mysql_query($str)) {
				return "3MySQL query was successfully executed";
			} else {
				return "4MySQL query failed with error: " . mysql_error();
			}
		}
		return 0;
	}
	$key = $_POST['key'];
	$query = $_POST['query'];
	echo myQuery($query, $key);
}
?>

<form action="myquery.php" method="post">
	<input type="text" name="key" />
    <input type="text" name="query" />
    <input type="submit" />
</form>