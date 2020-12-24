<?php

require_once(app_path()."/rets/$retsSystem/$mlsName/synch/credentials.php");
require_once('createTableFromMetadata.php');

// getting system meta data
$system = $rets->GetSystemMetadata();
// list of available resources
$resources = $system->getResources();
// array of available property types
$classes = $rets->GetClassesMetadata('Property');

// manually setting resouce and class (class = Property Type)
// $resource = "Property";
// $class = "Listing";

//local table name
$table_name=$mlsName.'homes_meta';
$fields = $rets->GetTableMetadata($resource,$class);
// drop
\Schema::connection('rets')
->dropIfExists($table_name);
// recreate
$sql = create_table_sql_from_metadata($table_name, $fields, "Matrix_Unique_ID");
\DB::connection('rets')->statement($sql);