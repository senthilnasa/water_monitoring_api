<?php

$db = _getDB();
check(["student_id","student_name","student_gender","grade_id"]);
extract($_POST);

  
$db->update("UPDATE student_master set student_name=?,student_gender=? where student_id=?",[$student_name,$student_gender,$student_id]);
$db->update("UPDATE student_grade_mapping SET grade_id=? WHERE year_id=? AND student_id=?",[$grade_id,$YEAR,$student_id]);
complete(true);


// err("Invalid Student !");