<?php

require '../_inc/db.php';

$postcard = db_load('postcards', $_GET['id']);

session_start();

if (!array_key_exists('basket', $_SESSION)) {
    $_SESSION['basket'] = array();
}

if (array_key_exists($postcard['id'], $_SESSION['basket'])) {
    $_SESSION['basket'][$postcard['id']] += 1;
} else {
    $_SESSION['basket'][$postcard['id']] = 1;
}

header("Location: /basket/index.php");
exit();
