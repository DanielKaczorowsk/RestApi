<?php
namespace restapi;
    interface ApiInterface
    {
        public function url(string $url):  ApiInterface;

        public function token($token):  ApiInterface;

        public function controller(array $controller):	ApiInterface;

        public function data(array $data):    ApiInterface;
        
        public function method(string $method): ApiInterface;

        public function sendRequest();
    }
    ?>