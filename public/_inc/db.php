<?php

function db_connect()
{
    return new SQLite3(__DIR__ . '/db.sqlite');
}

function db_load($table, $id)
{
    $db = db_connect();

    return $db->querySingle("SELECT * FROM postcards WHERE id = " . $_GET['id'], true);
}
