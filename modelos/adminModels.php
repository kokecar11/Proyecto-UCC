<?php

        if($petiAjax){
            require_once "../core/mainModel.php";

        }else{

            require_once "./core/mainModel.php";
        }   


        class adminModels extends mainModel{

            protected function add_coord_model($datos){

                $sql=mainModel::connection()->prepare("INSERT INTO gp_acc(Cuenta_Acc_cod,Grupos_Gp_cod) VALUES(:gp_acc_cod,:gp_gp_cod)");
                        $sql->bindParam(":gp_acc_cod",$datos['gp_acc_cod']);
                        $sql->bindParam(":gp_gp_cod",$datos['gp_gp_cod']);
                        $sql->execute();
                        return $sql;


            }



            protected function data_coord_model($tipo,$codigo_admn){
                if($tipo=="Unico"){
                    $query=mainModel::connection()->prepare("SELECT * FROM cuenta WHERE Acc_cod=:codigo_adm");
                    $query->bindParam(":codigo_adm",$codigo_admn);

                }elseif($tipo=="Count"){
                    $query=mainModel::connection()->prepare("SELECT Acc_cod FROM cuenta ");
                }
                $query->execute();
                return $query;
            }

        }