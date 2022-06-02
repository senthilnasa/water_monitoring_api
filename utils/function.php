<?php

$GLOBALS["DB"] = null;

function _getDB()
{
    if ($GLOBALS["DB"] == null) {
        $GLOBALS["DB"] = new CRUD;
    }
    return $GLOBALS["DB"];
}


function salt($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}