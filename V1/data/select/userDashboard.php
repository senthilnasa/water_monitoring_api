<?php

complete(_getDB()->select("SELECT '1002' d0, IFNULL((SELECT SUM(amount) FROM `device_allowed` WHERE device_id='1002' AND isdefault_amount=1),0) d5,(SELECT IFNULL(SUM(amount),0) FROM `device_allowed` WHERE device_id='1002' AND isdefault_amount<>1) d4,IFNULL((SELECT  flowrate FROM device_data dd WHERE dd.`device_id`='1002' LIMIT 1),0) d1,(SELECT  SUM(ml) FROM device_data dd WHERE dd.`device_id`='1002')d2,(SELECT IF(IFNULL(SUM(ml),0)-d2<0,IFNULL(SUM(ml),0)-d2,0) FROM device_allowed da WHERE da.`isdefault_amount`=1 AND da.`device_id`='1002')d3,(SELECT SUM(amount) FROM device_allowed da WHERE device_id='1002')d6"));