<?php

check(["user_id","role_id","user_name","user_mail_id","state"]);
extract($_POST);
if(_getDB()->update("update user_master set role_id=?,user_name=?,user_mail_id=?,state=? where user_id=?",[$role_id,$user_name,$user_mail_id,$state,$user_id])){
    complete(true);
}
err("No Changes Made");
