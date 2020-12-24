<?php

require_once(app_path()."/rets/$retsSystem/$mlsName/synch/credentials.php");
require_once('createTableFromMetadata.php');

$thisProcess='metaTable_reset';

// getting system meta data
$system = $rets->GetSystemMetadata();
// list of available resources
$resources = $system->getResources();
// array of available property types
$classes = $rets->GetClassesMetadata($searchResource);

//local table name
$fields = $rets->GetTableMetadata($searchResource,$searchClass);

//set table
$tableDrop=$metaTable;
//log the tableDrop for progress monitor
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableDrop.php");

// drop
\Schema::connection('rets')
->dropIfExists($metaTable);
// recreate
$sql = create_table_sql_from_metadata($metaTable, $fields, "Matrix_Unique_ID");
//run query
\DB::connection('rets')->statement($sql);

//set
$insertNow=NULL;
//log the tableDrop for progress monitor
include(app_path()."/rets/$retsSystem/$mlsName/synch/progress/tableCreate.php");