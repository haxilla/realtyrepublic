<?php
/*
$old_path = getcwd();
//chdir('/more');
$output = shell_exec('atomOpen.bin .env-dev');
//chdir($old_path);
dd($output);
*/
$appPath=app_path();

$output = array();
exec("$appPath/devJournal/scripts/atomOpen.bin .env-dev 2>&1", $output);
dd($output);
