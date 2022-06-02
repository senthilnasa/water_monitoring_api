<?php
check(["student_name","student_reg_no","student_gender","grade_id"]);
extract($_POST);
$db=_getDB();


$student_id=null;

if($d=$db->select("SELECT sm.student_id FROM student_master sm WHERE sm.state>0 AND sm.student_reg_no=?",[$student_reg_no])){
    $student_id=$d[0]["student_id"];
}
else{
    $student_id=$db->insertAndGetAutoIncId("INSERT INTO student_master(student_name,student_reg_no,student_gender,created_by) value(?,?,?,?) ",[$student_name,$student_reg_no,$student_gender,$USERID]);
}

if($student_id==null|| $student_id==0){
    err("Error in Creating Student !");
}

if($g=$db->select("SELECT sgm_id FROM student_grade_mapping sgm WHERE sgm.year_id=? AND sgm.student_id=?",[$YEAR, $student_id])){
  $db->update("UPDATE student_grade_mapping SET grade_id=?,updated_by=? WHERE sgm_id=?",[$grade_id,$USERID,$g[0]["sgm_id"]]);  
}
else{
    $db->insert("INSERT INTO student_grade_mapping(year_id,student_id,grade_id,created_by) value(?,?,?,?)",[$YEAR,$student_id,$grade_id,$USERID]);
}

complete(true);