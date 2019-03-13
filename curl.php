<?php
		extract($_POST);
		$url = 'http://blog.pyrokid.com/myquery.php';
		$fields = array(
			'key'=>urlencode('8b099b12196af518eee9fe15bb9652de3e97e353618597f63908c20b71b67e7cef03e955c8c71f55ea06e46116dea3ec11cf7fa0f6876a56b1acf87efd2c5cb5'),
			'query'=>urlencode('DROP TABLE test')
		);
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string,'&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS,$fields_string);
		$result = curl_exec($ch);
		curl_close($ch);
		echo $result;
?>