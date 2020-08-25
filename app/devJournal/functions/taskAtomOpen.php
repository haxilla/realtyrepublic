<?php

$old_path = getcwd();
//chdir('/more');
$output = shell_exec('atomOpaen.bin .env-dev');
//chdir($old_path);
