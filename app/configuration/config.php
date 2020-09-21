<?php

    namespace MyApp\Configuration;

    class config{

        public static function SERVER(){
            return [
                "SERVER_NAME"=> "localhost",
                "USER"       => "root",
                "PASSWORD"   => "",
                "DATABASE"   => ""
            ];
        }

        public static function APP(){
            return [
                "URL"             => "http://localhost/Arquitecturas/update_composer/",
                "ROOT"            => dirname(dirname(__DIR__)),
                "ROOT_CONTROLLER" => dirname(__DIR__)."//controllers//"
            ];
        }

    }
