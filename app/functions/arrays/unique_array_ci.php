<?php

//case insensitive unique
function array_iunique( $array ) {
    return array_intersect_key(
        $array,
        array_unique( array_map( "strtolower", $array ) )
    );
}