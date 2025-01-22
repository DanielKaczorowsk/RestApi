<?php
namespace view;
use web\web as web;
use template\open_template as open;
use controller\controller as controller;
include "../"."SPL_autoload_register.php";
$url = $_SERVER['REQUEST_URI'];
$reurl = explode('/',$url);
$request = $reurl[array_key_last($reurl)];
	$web = new web;
	if($url === '/')
	{
		$web->router_web('/',[controller::class,'home',Null],'GET');
	}
	elseif($reurl[1]==='produkt')
	{
		$web->router_web('/produkt',[controller::class, 'show_produkt',$request],'GET');
	}
	else
	{
		$web->router_web('/unknown',Null,'GET');
	}
	return $web;
?>