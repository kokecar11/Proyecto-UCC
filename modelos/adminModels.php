<?php

        if($petiAjax){
            require_once "../core/mainModel.php";

        }else{

            require_once "./core/mainModel.php";
        }   


        class adminModels extends mainModel{

            protected function add_coord_model($datos){

                $sql=mainModel::connection()->prepare("INSERT INTO gp_acc(Grupos_Gp_cod,Cuenta_Acc_cod,Gp_Acc_file,Gp_Acc_score) 
                        VALUES(:gp_gp_cod,:gp_acc_cod,:gp_file,:gp_score)");
                        $sql->bindParam(":gp_gp_cod",$datos['gp_gp_cod']);
                        $sql->bindParam(":gp_acc_cod",$datos['gp_acc_cod']);
                        $sql->bindParam(":gp_file",$datos['gp_file']);
                        $sql->bindParam(":gp_score",$datos['gp_score']);
                        $sql->execute();
                        return $sql;


            }

        }