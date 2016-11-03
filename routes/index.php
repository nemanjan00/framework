<?php
$klein = new \Klein\Klein();

$auth->setBadAuthFunction(function($request, $response){
	$response->redirect("/login");
});

$klein->respond('GET', '/login/', function ($request, $response) {
	global $auth;
	global $views;

	if($auth->isAuthenticated()){
		$response->redirect("/panel");
	}
	else
	{
		return $views->getView('login.html');
	}
});

$klein->respond('GET', '/logout/', function ($request, $response) {
	global $auth;

	$auth->logout();
	$response->redirect("/login/");
});

$klein->respond('POST', '/login/', function ($request, $response) {
	global $auth;

	if($auth->isAuthenticated() || $auth->login(@$_POST["username"], @$_POST["password"])){
		$response->redirect("/panel");
	}
	else
	{
		return $views->getView('login.html');
	}
});

$klein->respond('GET', '/', function ($request, $response) {
	global $auth;

	if($auth->isAuthenticated()){
		$response->redirect("/panel");
	}
	else
	{
		$response->redirect("/login");
	}
});

//$klein->with("/panel", __DIR__."/panel/index.php");

$klein->dispatch();

