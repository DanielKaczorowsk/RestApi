<?php
namespace template;
use template\template as template;
include "../"."SPL_autoload_register.php";

	if(isset($_POST['url']))
	{
		$url = $_POST['url'];
	}
	if(isset($_POST['controller']))
	{
		$data = $_POST['controller'];
		foreach($data as $key => $value)
		{
			$product = $value;
		}
	}
		$file_t = __DIR__.'\..\view\template\template.php';
		if($url === '/')
		{
			$file = __DIR__.'\..\view\template\index.php';
		}
		else
		{
			$file = __DIR__.'\..\view\template'.$url.'.php';
		}
		$template = new template();
		if(isset($_POST['controller']))
		{
			$data = $template
					->file($file_t)
					->title('Sklep')
					->data($data)
					->contents($file)
					->render();
		}
		else
		{
			$data = $template
						->file($file_t)
						->title('Sklep')
						->contents($file)
						->render();
		}
		 echo $data;
?>