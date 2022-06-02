<?php

if (!isset($_GET['path']) || empty($_GET['path']) || !is_string($_GET['path'])) {
    err('Invalid Request !', 404);
}

$_PATH = $_GET['path'];

require __DIR__ . '/../../utils/init.php';

$USERID=1;

// if($_PATH!='me'){
//     err("Invalid Request Parameter !");
// }

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $_file = __DIR__ . '/select/' . $_PATH  . '.php';
    if (!file_exists($_file))
        err('Request not found !', 404);
    require $_file;
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_file = __DIR__ . '/update/' . $_PATH  . '.php';
    if (!file_exists($_file))
        err('Request not found !', 404);
    if (empty($_POST))
        $_POST = json_decode(file_get_contents('php://input'), true);
    require $_file;
}else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $_file = __DIR__ . '/insert/' . $_PATH  . '.php';
    if (!file_exists($_file))
        err('Request not found !', 404);
    if (empty($_POST))
        $_POST = json_decode(file_get_contents('php://input'), true);
    require $_file;
}


function  validateLogin() :int
{
$token = getBearerToken();
$deviceId = getDeviceId();
if ($token == null||$deviceId==null) {
    err('Invalid Request !121', 404);
    return null;
}
$_db=_getDB();
if(!$user=$_db ->select("SELECT t.`user_id` FROM app_token t WHERE t.`last_ping` > NOW() - INTERVAL 5 DAY AND t.`device_id`=? AND t.`token`=? ",[$deviceId ,$token])){
    err("Session Expired");
}
return $user[0]["user_id"];
}