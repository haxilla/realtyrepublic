<?php

//mysql connection
$pdo = \DB::connection('adre')->getPdo();

//Individuals
$pdo->exec("
LOAD DATA INFILE '$finalFile'
IGNORE INTO TABLE $mainTable
FIELDS TERMINATED BY ','
ENCLOSED BY '\"'
LINES TERMINATED BY '\\r\\n'
IGNORE 1 LINES");
