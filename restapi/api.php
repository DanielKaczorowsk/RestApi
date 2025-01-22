<?php 
namespace restapi;

	class api implements ApiInterface
	{
		protected $query,$data;
		protected function reset(): void
		{
		$this->query = new \stdClass();
		}
		public function url(string $url):	ApiInterface
		{
			$this->reset();
			$this->query->url = 'http://localhost/'.$url;
			return $this;
		}
		public function templateUrl(string $url)
		{
			$this->query->templateUrl = $url;
			return $this;
		}
		public function token($token):	ApiInterface
		{
			$this->query->token = $token;
			return $this;
		}
		public function controller(array $controller):	ApiInterface
		{
			if(isset($this->query->url))
			{
				$this->query->controller = $controller;
			}
			else
			{
				$this->reset();
				$this->query->controller = $controller;
			}
			return $this;
		}
		public function data(array $data):	ApiInterface
		{
			$this->query->data = $data;
			return $this;
		}
		public function method(string $method): ApiInterface
		{
			$this->query->method = $method;
			return $this;
		}
		public function sendRequest()
		{
			$data['url'] = $this->query->templateUrl;
			if(isset($this->query->controller))
			{
				[$controller,$function,$request] = $this->query->controller;
				$controllerInstance = new $controller;
				if(isset($request))
				{
					$data['controller'] = $controllerInstance->{$function}($request);
				}else
				{
					$data['controller'] = $controllerInstance->{$function}();
				}
			}
			else if(isset($this->query->data))
			{
				$data['data'] = $this->query->data;
			}
			$this->query->data = http_build_query($data);
			$ch = curl_init();
			if(isset($this->query->url))
			{
				curl_setopt($ch, CURLOPT_URL, $this->query->url);
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			if($this->query->method === 'GET')
			{
				curl_setopt($ch, CURLOPT_HTTPGET, true);
				if(isset($this->query->data))
				{
					curl_setopt($ch, CURLOPT_POSTFIELDS,$this->query->data);
				}
				else
				{
					var_dump($this->data);
					curl_setopt($ch, CURLOPT_POSTFIELDS,$this->data);
				}
			}
			else if($this->query->method === 'POST')
			{
				curl_setopt($ch, CURLOPT_POST,true);
				curl_setopt($ch, CURLOPT_POSTFIELDS,$this->query->data);
			}
			else if ($this->query->method === 'PUT')
			{
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST,	'PUT');
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->query->data));
			}
			else if ($this->query->method === 'DELETE')
			{
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
			}
			//$_SESSION[$this->query->token];
			$response = curl_exec($ch);
			$httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
			$error = curl_error($ch);
			curl_close($ch);
			if ($error !== '')
			{
				throw new \Exception($error);
			}
			//return json_encode(['response'=>$response,'http_code'=>$httpCode]);
			return json_encode($response);
		}
	}