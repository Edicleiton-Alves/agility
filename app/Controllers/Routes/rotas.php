<?php

$app = new Classes\Routes;

$app->get('/', function ()
{
	require PATH['Views'].'home/default.php';
});

$app->get('/logout', function () {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    unset($_SESSION['ACCESS_ADMIN']);
    header('Location: /admin');
    exit;
});
