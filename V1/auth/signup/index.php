<?php
require __DIR__."/../../../utils/init.php";

check(["mailId","password","name"],"Invalid Request");

extract($_POST);

if(getDeviceId()==null){
    err("Invalid Request !");
}

$_db=_getDB();

if(!$user=$_db ->insertAndGetAutoIncId("INSERT INTO `user_master`(user_name,user_mail,role_id) VALUES(?,?,2)",[$name,$mailId])){
    err("User Already Exist !!");
}
$_salt=salt();
$_db->insert("INSERT INTO user_password(user_id,user_salt,user_password) VALUES(?,?,MD5(SHA(CONCAT(?,?,?))))",[$user,$_salt,$_salt,$password,$_salt]);
$token=salt(15);
$_db->insert("INSERT INTO `app_token`(token,user_id,device_id) VALUE(?,?,?)",[$token,$user,getDeviceId()]);
complete($token);
