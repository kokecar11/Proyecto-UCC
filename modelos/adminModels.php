<?php

        if($petiAjax){
            require_once "../core/mainModel.php";

        }else{

            require_once "./core/mainModel.php";
        }   


        class adminModels extends mainModel{

            protected function add_coord_model($datos){

                $sql=mainModel::connection()->prepare("INSERT INTO coordinador(C_Acc_cod,Coord_names,Coord_lastnames) 
                        VALUES(:acc_email,:names,:lastnames)");
                        $sql->bindParam(":acc_email",$datos['acc_email']);
                        $sql->bindParam(":names",$datos['names']);
                        $sql->bindParam(":lastnames",$datos['lastnames']);
                        $sql->execute();
                        return $sql;


            }

        }