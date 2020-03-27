<?php

//backup prep
include('includes/propflyerdelete/backup_1prep_propflyerdelete.php');
//first backup
include('includes/propflyerdelete/backup_2first_propflyerdelete.php');
//create federated
include('includes/propflyerdelete/federated_1recreate_propflyerdelete.php');
//insert federated
include('includes/propflyerdelete/federated_2insert_propflyerdelete.php');
//final backup
include('includes/propflyerdelete/backup_3final_propflyerdelete.php');