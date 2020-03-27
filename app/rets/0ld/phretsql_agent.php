<?php

require_once('includes/login.php');
require_once('function/create_table_sql_from_metadata.php');

// getting system meta data
$system = $rets->GetSystemMetadata();

// list of available resources
$resources = $system->getResources();

// array of available property types
$classes = $rets->GetClassesMetadata('Agent');

// manually setting resouce and class
$resource = "Agent";
$class = "Agent";

$table_name = "rets_".strtolower($resource)."_".strtolower($class);
$fields = $rets->GetTableMetadata($resource,$class);

$sql = create_table_sql_from_metadata($table_name, $fields, "Matrix_Unique_ID");
\DB::statement($sql);