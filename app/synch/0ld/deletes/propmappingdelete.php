<?php

//backup prep
include('includes/propmappingdelete/backup_1prep_propmappingdelete');
//first backup
include('includes/propmappingdelete/backup_2first_propmappingdelete');
//create federated
include('includes/propmappingdelete/federated_1recreate_propmappingdelete');
//insert federated
include('includes/propmappingdelete/federated_2insert_propmappingdelete');
//final backup
include('includes/propmappingdelete/backup_3final_propmappingdelete');

$partialSynch=1;
$partialNext='propmetadelete';