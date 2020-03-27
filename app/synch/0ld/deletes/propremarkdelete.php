<?php

//backup prep
include('includes/propremarkdelete/backup_1prep_propremarkdelete.php');
//backup first
include('includes/propremarkdelete/backup_2first_propremarkdelete.php');
//federated recreate
include('includes/propremarkdelete/federated_1recreate_propremarkdelete.php');
//federated insert
include('includes/propremarkdelete/federated_2insert_propremarkdelete.php');
//backup final
include('includes/propremarkdelete/backup_3final_propremarkdelete.php');
