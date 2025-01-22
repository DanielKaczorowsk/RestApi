# RestApi
    $web = new web;
    $web->router_web('/',[controller::class,'function class',$request],'GET'); you dont have $request write Null
    This is primaty settings in web/web.php
# Template
    $data = $template
		->file($file_t)
		->title('Sklep')
		->data($data) -> this is data post in controller in layouts use @startforeach {foreach-key} @endforeach, you must create folder and file controller/controller.php
		->contents($file)
		->render();
    This is primary settings in template/open_template.php
# Create new file in template
    Create new file in folder view/template
    file template is primary html
    create next layouts file and change create function in file public/index.php
