<?php


function db(): \mysqli
{
    try {
        $db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME,DB_PORT);
        return $db;
    } catch (\Throwable $th) {
        err('Connection error' . $th->getMessage());
    } catch (\Error $e) {
        err($e->getMessage());
    } catch (\Exception $e) {
        err($e->getMessage());
    }
}

?>