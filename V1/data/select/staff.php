<?php

$db=_getDB();

$users=$db->select("SELECT um.`role_id`,um.`user_id`,um.`user_name`,um.`user_mail_id`,um.state FROM user_master um WHERE um.`role_id`<>1");
$roles=$db->select("SELECT role_name,role_id FROM role_master WHERE role_id<>1");
complete([
    "users"=>$users,
    "roles"=>$roles
]);