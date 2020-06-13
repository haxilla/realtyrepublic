<?php
//working load data infile

$pdo = \DB::connection()->getPdo();
//Individuals
$pdo->exec("
LOAD DATA LOCAL INFILE '".'c:/websites/rosemary/app/adre/uploads/Individuals.txt'."'
INTO TABLE adre.adreagents
FIELDS TERMINATED BY ','
ENCLOSED BY '\"'
LINES TERMINATED BY '\\r\\n'
IGNORE 1 LINES");
//entities
$pdo->exec("
LOAD DATA LOCAL INFILE '".'c:/websites/rosemary/app/adre/uploads/Entities.txt'."'
INTO TABLE adre.adreentities
FIELDS TERMINATED BY ','
ENCLOSED BY '\"'
LINES TERMINATED BY '\\r\\n'
IGNORE 1 LINES");


