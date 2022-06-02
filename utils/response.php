<?php

function err(string $err, int $code = 400): void
{
    $res = array();
    $res['ok'] = false;
    $res['err-msg'] = $err;
    $res['err-code'] = $code;
    
    _finish($res);
}

function complete($data): void
{
    $res = array();
    $res['ok'] = true;
    $res['data'] = $data;
    _finish($res);
}

function _finish(array $res): void
{
    
    header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
    header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time() - (60 * 60)));
    header('Pragma: no-cache');
    header('Content-Type: application/json');
    header("x-powered-by: Best Buddy Team");
    header("x-turbo-charged-by: Best Buddy Server");
    echo json_encode($res, JSON_PRETTY_PRINT);
    die();
}
?>