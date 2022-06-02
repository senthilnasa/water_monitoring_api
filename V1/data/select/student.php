<?php

$db=_getDB();
$result["students"]=$db->select("SELECT sm.`student_id`,sm.`student_name`,sm.`student_reg_no`,sm.`student_gender`,sgm.`grade_id` FROM `student_master` sm INNER JOIN `student_grade_mapping` sgm ON sgm.`student_id`=sm.`student_id` AND sm.`state`>0 AND sgm.`state`>0 AND sgm.`year_id`=?",[$YEAR]);
$result["grades"]=$db->select("SELECT gm.`grade_id`,gm.`grade_name` FROM `grade_master` gm WHERE gm.`state`>0");
complete($result);
