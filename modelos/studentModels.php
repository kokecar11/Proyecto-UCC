<?php

        if($petiAjax){
            require_once "../core/mainModel.php";

        }else{

            require_once "./core/mainModel.php";
        }   


        class studentModels extends mainModel{

            protected function add_student_model($datos){

                $sql=mainModel::connection()->prepare("INSERT INTO gp_acc(Cuenta_Acc_cod,Grupos_Gp_cod) VALUES(:gp_acc_cod,:gp_gp_cod)");
                        $sql->bindParam(":gp_acc_cod",$datos['gp_acc_cod']);
                        $sql->bindParam(":gp_gp_cod",$datos['gp_gp_cod']);
                        $sql->execute();
                        return $sql;


            }

        }