<?php

$host = "";
$username = "";
$password = "";
$db_name = "";

mysql_connect("$host", "$username", "$password")or die("cannot connect");
mysql_select_db("$db_name")or die("cannot select DB");

if(isset($_GET['page']) && is_numeric($_GET['page']))
{
	$page = mysql_real_escape_string($_GET['page']);
} else {
	$page = 1;
}
$max = 10;
$cur = (($page * $max) - $max);

function is_empty($var, $allow_false = false, $allow_ws = false) {
	if (!isset($var) || is_null($var) || ($allow_ws == false && trim($var) == "" && !is_bool($var)) || ($allow_false === false && is_bool($var) && $var === false) || (is_array($var) && empty($var))) {    
		return true;
	} else {
		return false;
	}
}

function cleanUser($name) { return trim(preg_replace('/[^A-Za-z0-9_ \-]/', '',$name)); }

function loggedIn() {
	if(isset($_COOKIE['pk_user'], $_COOKIE['pk_pass'], $_COOKIE['pk_level'])) {
		return 1;
	}
	return 0;
}

function getUser() {
	if(loggedIn()) {
		return $_COOKIE['pk_user'];
	}
	return 0;
}

function getLevel() {
	if(loggedIn()) {
		return $_COOKIE['pk_level'];
	}
	return 0;
}

function cleanTitle($str) {
	$str = cleanUser($str);
	$str = strtolower(str_replace(' ', '-', $str));
	return $str;
}

if(loggedIn()) {
	$check = mysql_query("SELECT * FROM newpk_users WHERE name='".$_COOKIE['pk_user']."'");
	if(mysql_num_rows($check) < 1) {
		setcookie("pk_user", 'del', time()-3600);
		setcookie("pk_pass", 'del', time()-3600);
		setcookie("pk_level", '0', time()-3600);
	}
	$rows = mysql_fetch_array($check);
	if($rows['last_ip'] != $_SERVER['REMOTE_ADDR']) {
		mysql_query("UPDATE newpk_users SET last_ip='" . $_SERVER['REMOTE_ADDR'] . "' WHERE name='".$_COOKIE['pk_user']."'");
	}
	if($_COOKIE['pk_level'] != $rows['level']) {
		setcookie("pk_level", '0', time()-3600);
	}
} else {
	setcookie("pk_level", '0', time()-3600);
}

function setLatest() {
	$result = mysql_query("SELECT * FROM newpk ORDER BY id DESC") or die("Query failed with error: ".mysql_error());
	$rows = mysql_fetch_array($result);
	
	$newtext = str_replace(array("\r\n", "\r", "\n"), ' ', $rows['text']);
	$newtext = substr($newtext, 0, 100) . '...';
	$newtext = strip_tags(stripslashes($newtext));
				
	file_put_contents('latest.php', $rows['id'] . " | " . $rows['safe-title'] . " | " . $rows['title'] . " | " . $rows['author']. " | " . date("M j, Y", $rows['date']) . " | " . $newtext);
}

setLatest();
?>