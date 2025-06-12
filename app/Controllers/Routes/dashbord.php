<?php 

$app->get('/admin', function ()
{
	require PATH['Views'].'dashboard/Login.php';
});

$app->post('/login', function ()
{
	require PATH['Requests'].'Login/Request_Login.php';
});