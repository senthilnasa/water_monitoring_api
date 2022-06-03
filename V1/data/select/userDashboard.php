<?php

complete(_getDB()->select("SELECT dd.`tds1`,dd.`tds2`,dd.`ml` FROM `device_data` dd WHERE device_id='1002'"));
