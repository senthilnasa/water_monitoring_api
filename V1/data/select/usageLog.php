<?php

complete(_getDB()->select("SELECT  ifnull(SUM(ml),0) d1 FROM device_data dd WHERE dd.`device_id`='1002'"));
