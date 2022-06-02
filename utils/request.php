<?php

$_POST = json_decode(file_get_contents('php://input'), true);

header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authentication, DeviceId, X-Requested-With, X-CSRF-Token, X-Turbo-Charged-By, X-Powered-By');

function check($query, $err = '')
{
    if (is_array($query))
        foreach ($query as $q)
            _checkPostValue($q, $err);
    else
        _checkPostValue($query, $err);
}

function checkGet($query, $err = '')
{
    if (is_array($query))
        foreach ($query as $q)
            _checkGetValue($q, $err);
    else
        _checkGetValue($query, $err);
}

function _checkGetValue($q, $err = '')
{
    if (!isset($_GET[$q])){
        if ($err == '')
            $err = str_replace('_', ' ', ucwords($q, '_')) . ' required';
        err($err, 400);
    }
}

function _checkPostValue(string $q, $err)
{
    if (!isset($_POST[$q])) {
        if ($err == '')
            $err = str_replace('_', ' ', ucwords($q, '_')) . ' required';
        err($err, 400);
    }
}



function get_client_ip()
{
	if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
		$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
		$_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
	}
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];

	if (filter_var($client, FILTER_VALIDATE_IP)) {
		$ip = $client;
	} elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
		$ip = $forward;
	} else {
		$ip = $remote;
	}

	return $ip;
}
function getAuthorizationHeader($key='Authorization'){
   
}

function getDeviceId($key = "DeviceId"){
    $headers = getallheaders();
    foreach ($headers as $header => $value) {
        if(strtolower($header) == strtolower($key)){
            return $value;
        }
    }
    return null;
}

function getBearerToken() {
    $key='Authorization';
    $token= null;
    $headers = getallheaders();
    var_dump($headers);
    foreach ($headers as $header => $value) {
        if(strtolower($header) == strtolower($key)){
            $token= $value;
        }
    }
    
    if ($token != null) {
        if (preg_match('/Bearer\s(\S+)/', $token, $matches)) {
            return $matches[1];
        }
    }
    return null;
}
?>