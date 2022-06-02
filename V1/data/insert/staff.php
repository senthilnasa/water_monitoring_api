<?php

check(["role_id","user_name","user_mail_id"]);
extract($_POST);
if(_getDB()->insert("insert into user_master(role_id,user_name,user_mail_id) values(?,?,?)",[$role_id,$user_name,$user_mail_id])){

    complete(true);
}
err("Mail Id Already Exists");