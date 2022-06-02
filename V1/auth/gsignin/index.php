<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__."/../../../utils/init.php";

check("token","Invalid Request !");

extract($_POST);

if(getDeviceId()==null){
    err("Invalid Request 1 !");
}

$_db=_getDB();
if(!$user=$_db ->select("SELECT MD5(CONCAT(NOW(),RAND(),user_id,NOW())) token,user_id FROM user_master um WHERE um.`user_mail`=? and state=1",[verifyToken($token)])){
    err("Invalid Creditentials");
}
$_db->insert("INSERT INTO `app_token`(token,user_id,device_id) VALUE(?,?,?)",[$user[0]["token"],$user[0]["user_id"],getDeviceId()]);
complete($user[0]["token"]);

function verifyToken($token): string
{
    try {
        $js = json_decode(file_get_contents('https://www.googleapis.com/oauth2/v2/tokeninfo?id_token=' . $token), true);
        if (!isset($js["email"])) {
            err("Invalid Request");
        }
        return $js["email"];
    } catch (Exception $e) {
        err("Invalid Request");
    }
    err("Invalid Request");
}