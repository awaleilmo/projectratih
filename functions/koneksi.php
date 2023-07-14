<?php

session_start();
date_default_timezone_set("Asia/Bangkok");
$db_name = 'project_ratih';
$db_connect = new Mysqli('localhost', 'root', '', 'project_ratih');
