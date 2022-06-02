<?php

$db=_getDB();
$user=$db->select("SELECT concat('https://ui-avatars.com/api/?rounded=true&name=',user_name)user_img, user_name,user_mail,role_id FROM `user_master` um WHERE um.`state`=1 AND um.`user_id`=1",[$USERID]);
$user[0]["menu"]=$db->select("SELECT r.`resource_name`,r.`resource_icon`,r.`resource_id` FROM  `role_master` rm INNER JOIN `resource_master` r ON FIND_IN_SET(r.`resource_id`,rm.`resources`) WHERE role_id=?", [$user[0]["role_id"]]);
unset($user[0]["role_id"]);
complete($user[0]);
