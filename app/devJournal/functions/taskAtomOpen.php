<?php

$old_path = getcwd();
chdir('/var/www/larasites/realtyemails/app/devJournal/scripts');
$output = shell_exec('atomOpen .env-dev');
chdir($old_path);

$output = shell_exec('./script.sh var1 var2');
