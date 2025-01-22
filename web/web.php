<?php 
	namespace web;
	use restapi\api;
	use view\index;
	use controller\controller as controller;
	include "../"."SPL_autoload_register.php";
	class web
	{
		public function router_web(string $url,$controller,string $method):	void
		{
			$api = new api;
			if($controller != Null)
			{
				$data = $api->url('template/open_template.php')
						->templateUrl($url)
						->controller($controller)
						->method($method)
						->sendRequest();
			}
			else
			{
				$data = $api->url('template/open_template.php')
						->templateUrl($url)
						->method($method)
						->sendRequest();
			}
			$widz = json_decode($data, true);
			print_r($widz);
		}
		public function router_api(string $url): void
		{
			$api = new api;
			$data = $api->url('http://localhost/controller/controller.php')
						->controller([controller::class, 'show_basket'])
						->method('Post')
						->sendRequest();
			$widz = json_decode($data, true);
			print_r($widz);
		}
	}
?>