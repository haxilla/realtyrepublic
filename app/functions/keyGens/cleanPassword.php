<?php

function cleanPassword($length = 8) {
    $characters = '2346789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRTUVWXYZ';
    $charactersLength = strlen($characters);
    $cleanPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $cleanPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $cleanPassword;
}
