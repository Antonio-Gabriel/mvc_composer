<?php

    namespace MyApp\core;
    use MyApp\Configuration\config;

    class Configuration{

        // Atributos
        
        private $controller;
        private $methods;
        private $params = [];

        public function __construct(){

            $this->verifyUrl();   
            $this->run();                    

        }


        private function verifyUrl(){

            if(isset($_GET['router'])){

                $route = trim($_GET['router'],'/');
                $route = filter_var($route, FILTER_SANITIZE_URL);
                $route = explode('/',$route);
                
                $this->controller = isset($route[0]) ? $route[0] : Null;
                $this->methods = isset($route[1]) ? $route[1] : Null;
                unset($route[0], $route[1]);

                $this->params = array_values($route);                
            }

        }

        private function run(){

            if(!$this->controller){
                       
                $loadPage = new \MyApp\Controllers\HomeController();
                $loadPage->index(); 

             }elseif(file_exists(config::APP()['ROOT_CONTROLLER'].$this->getController($this->controller).".php")){
                 
                 $controller = $this->getNamespace($this->getController($this->controller));
                 $this->controller = new $controller();

                 if(
                     method_exists($this->controller,$this->methods) &&
                     is_callable(array($this->controller,$this->methods))
                   ){

                     if(!empty($this->params)){
                         call_user_func_array(
                             [
                                 $this->controller,
                                 $this->methods
                             ],
                             $this->params
                         );
                     }else{
                         $this->controller->{$this->methods}();
                     }

                 }else{

                     if(strlen($this->methods) == 0){
                         $this->controller->index();
                     }else{
                         $loadPage = new \MyApp\Controllers\ErrorController();
                         $loadPage->index();
                     }

                 }

             }else{
                 $loadPage = new \MyApp\Controllers\ErrorController();
                 $loadPage->index();
             }
             
        }

        #retorna o namespace para as classes

        private function getNamespace($var): string
        {
            $namespace = "MyApp\\Controllers\\".ucfirst($var);
            return $namespace;
        }

        #para setar as sessions
        public function session(){
            var_dump(config::APP()['URL']);
        }

        private function getController($controler){
            return $controler.'Controller';
        }


    }