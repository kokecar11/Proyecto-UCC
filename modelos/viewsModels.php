<?php

    class viewsModels{
        // En esta funcion va devolver si la palabra esta en la lista blanca
        protected function obt_views_models($viewss){
            $listWhite = ["admin","adminlist","adminsearch","catalog","category","categorylist",
            "teacher","teacherlist","teachersearch","grouplist","group","home","login","myacc","mydata",
            "provider","providerlist","proyecto",
            "proyectoconfig","proyectoinfo","search","student"];

            if(in_array($viewss,$listWhite)){
                if(is_file("./vistas/contenidos/".$viewss."-view.php")){
                    $answerCont="./vistas/contenidos/".$viewss."-view.php";
                }else{
                    $answerCont="login";
                }

            }elseif($viewss=="login"){
                $answerCont="login";

            }elseif($viewss=="index"){
                $answerCont="login";

            }else{
                $answerCont="404";
            }

            return $answerCont;
        }

        
    }