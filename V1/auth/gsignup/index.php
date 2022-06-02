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
$mailId=verifyToken($token);
if(!$user=$_db ->insertAndGetAutoIncId("INSERT INTO `user_master`(user_name,user_mail,role_id) VALUES(?,?,2)",[$name,$mailId])){
    err("User Already Exist !!");
}

$_salt=salt();
$token=salt(15);
$_db->insert("INSERT INTO `app_token`(token,user_id,device_id) VALUE(?,?,?)",[$token,$user,getDeviceId()]);
complete($token);

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