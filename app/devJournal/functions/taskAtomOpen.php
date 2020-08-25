<?php

$old_path = getcwd();
//chdir('/more');
$output = shell_exec('atomOpen.bin .env-dev');
//chdir($old_path);
dd($output);
