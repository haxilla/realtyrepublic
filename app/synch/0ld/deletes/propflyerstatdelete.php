<?php

//backup table prep
include('includes/propflyerstatdelete/backup_1prep_propflyerstatdelete');

//backup table prep
include('includes/propflyerstatdelete/backup_2first_propflyerstatdelete');

//recreate federated
include('includes/propflyerstatdelete/federated_1recreate_propflyerstatdelete');

//insert federated
include('includes/propflyerstatdelete/federated_2insert_propflyerstatdelete');

//final backup
include('includes/propflyerstatdelete/backup_3final_propflyerstatdelete');

$partialSynch=1;
$partialNext='propmappingdelete';