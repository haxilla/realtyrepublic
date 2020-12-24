<?php 

$connect = $rets->Login();
$file = fopen('output/Property-A-fields.csv', 'r');
$header = fgetcsv($file);
$fields = array();
while (($result = fgetcsv($file)) !== false) {
    $fields[] = $result[0];
}
foreach ($property_classes as $class) {
    echo "+ Property:{$class}<br>\n";
    $file_name = strtolower("data/property_{$class}_data.csv");
    $fh = fopen($file_name, "w+");
    fputcsv($fh, $fields);
    $maxrows = true;
    //$offset = 1;
    $limit = 500;
    $fields_order = array();
    $resource = "Property";
    $query = "({$rets_modtimestamp_field}={$newdatestring}+)";
    while ($maxrows) {
        // run RETS search
        echo "   + Query: {$query}  Limit: {$limit}  Offset: {$offset}<br>\n";
        $results = $rets->Search($resource, $class, $query, ['QueryType' => 'DMQL2', 'Count' => 1, 'Format' => 'COMPACT-DECODED', 'Limit' => $limit, 'Offset' => $offset, 'StandardNames' => 0]);
        $properties = array();
        foreach ($results as $record) {
            $property = array();
            foreach ($fields as $field) {
                $property[$field] = $record[$field];
            }
            $properties[] = $property;
            fputcsv($fh, $property);
        }
        // update offset
        $offset = $offset + count($results);
        echo 'offset is now ' . $offset;
        $maxrows = $results->isMaxRowsReached();
    }
    var_dump($properties);
    fclose($fh);
    echo "  - done<br>\n";
}
echo "+ Disconnecting<br>\n";
$rets->Disconnect();