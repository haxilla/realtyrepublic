<?php

// create array
$theLoop=array(
    //start
    'Individuals'   => array(
        'className'         =>'Individuals',
        'thisComplete'      =>'IndividualEnd',
        'schema'            =>'adre',
        'mainTable'         =>'ADRE_agents',
        'newCountField'     =>'agentNewTotal',
        'statusCountField'  =>'agentStatusTotal',
        'exCountField'      =>'exAgentCount',
        'finalFile'         =>'ADRE_agents.txt',
        'lastLog'           => null,
        'regexFile'         =>'/unescapedQuotes.php',),
    'Entities'      => array(
        'className'         =>'Entities',
        'thisComplete'      =>'EntityEnd',
        'schema'            =>'adre',
        'mainTable'         =>'ADRE_entities',
        'newCountField'     =>'entityNewTotal',
        'statusCountField'  =>'entityStatusTotal',
        'exCountField'      =>'exEntityCount',
        'finalFile'         =>'ADRE_entities.txt',
        'lastLog'           =>1,
        'regexFile'         =>null,),
    //end
    );