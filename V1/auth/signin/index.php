<?php
require __DIR__."/../../../utils/init.php";

check("mailId","password","Invalid Request");

extract($_POST);

if(getDeviceId()==null){
    err("Invalid Request !");
}



$_db=_getDB();
if(!$user=$_db ->select("SELECT  MD5(CONCAT(NOW(),RAND(),um.user_id,NOW())) token,um.user_id FROM `user_password` up INNER JOIN user_master um ON um.`user_id`=up.`user_id` WHERE up.user_password=MD5(SHA(CONCAT(up.`user_salt`,?,up.`user_salt`))) AND um.`user_mail`=?",[$password,$mailId])){
    err("Invalid Creditentials");
}
$_db->insert("INSERT INTO `app_token`(token,user_id,device_id) VALUE(?,?,?)",[$user[0]["token"],$user[0]["user_id"],getDeviceId()]);
complete($user[0]["token"]);
