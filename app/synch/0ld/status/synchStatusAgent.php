<?php

Use App\models\core\propagent;
Use App\models\federated\emailagents_federated;

$localAgentCount=propagent::count();
$oldAgentCount=emailagents_federated::count();

$idArray = array(
   'oldAgentCount'   => $oldAgentCount,
   'localAgentCount' => $localAgentCount,
);

echo json_encode($idArray);
exit();
