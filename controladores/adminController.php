<?php

        if($petiAjax){
            require_once "../modelos/adminModels.php";

        }else{

            require_once "./modelos/adminModels.php";
        }   

        class adminController extends adminModels{
            
        }