<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../../utils/init.php';
checkGet(['device_id','device_key','ml','rate']);
extract($_GET);
$db=_getDB();
$data=$db->select("SELECT * ,ifnull((SELECT SUM(da.`ml`) FROM `device_allowed` da WHERE da.`device_id`=dm.device_id AND state=1),0)-ifnull((SELECT SUM(dd.`ml`) FROM `device_data` dd WHERE dd.`device_id`=dm.`device_id`),0) lim FROM device_master dm  WHERE dm.`device_id`=? AND dm.`device_key`=?",[$device_id,$device_key]);
if($ml>0){
    $db->insert("INSERT INTO `device_data`(device_id,flowrate,ml) VALUE(?,?,?)",[$device_id,$rate,$ml]);
}
die("ON");