<?php

// GREAT WORKING FUNCTION!!
// DO NOT LOSE
// will match values and find all keys

function filter_by_value ($array, $index, $value){

    if(is_array($array) && count($array)>0)
    {
        foreach(array_keys($array) as $key){
            $temp[$key] = $array[$key][$index];

            if ($temp[$key] == $value){
             $newarray[$key] = $array[$key];
            }
        }
    }

    if(!isset($newarray)){
        $newarray=null;}

    return $newarray;

}
