<?php
//backup prep
include('includes/propmetadelete/backup_1prep_propmetadelete.php');
//first backup
include('includes/propmetadelete/backup_2first_propmetadelete.php');
//first backup
include('includes/propmetadelete/federated_1recreate_propmetadelete.php');
//first backup
include('includes/propmetadelete/federated_2insert_propmetadelete.php');
//first backup
include('includes/propmetadelete/backup_3final_propmetadelete.php');

$partialSynch=1;
$partialNext='propremarkdelete';