<?php

    namespace MyApp\Controllers;

    class homeController{

        public function index()
        {
            echo "HOME";
            echo "<a href='home/post/1/add'>POSTAGEM</a>";
        }

        public function post($id)
        {
            echo 'POSTAGENS';
            echo '</br>';
            echo $id;
        }

    }