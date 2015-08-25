<?php

require '../_inc/db.php';

$postcard = db_load('postcards', $_GET['id']);

session_start();

if (!array_key_exists('basket', $_SESSION)) {
    $_SESSION['basket'] = array();
}

if (array_key_exists($postcard['id'], $_SESSION['basket'])) {
    unset ($_SESSION['basket'][$postcard['id']]);
} else {
    die('Product not in the basket!');
}

header("Location: /basket/index.php");
exit();
