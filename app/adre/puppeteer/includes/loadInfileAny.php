<?php

//mysql connection
$pdo = \DB::connection($schema)->getPdo();

//Individuals
$pdo->exec("
LOAD DATA INFILE '$finalFilePath'
IGNORE INTO TABLE $mainTable
FIELDS TERMINATED BY ','
ENCLOSED BY '\"'
LINES TERMINATED BY '\\r\\n'
IGNORE 1 LINES");
