<?php


        if($petiAjax){
            require_once "../modelos/groupModels.php";
        }else{
            require_once "./modelos/groupModels.php";
        }   

        class groupController extends adminModels{

            public function add_group_controller(){
                    
                    $namegp=mainModel::clean_cadn($_POST['nombregp-reg']);
                    $stu_n1=mainModel::clean_cadn($_POST['Estudiante1-reg']);
                    $stu_n2=mainModel::clean_cadn($_POST['Estudiante2-reg']);
                    $asesor=mainModel::clean_cadn($_POST['Asesor-reg']);
                    $jurado_n1=mainModel::clean_cadn($_POST['Jurado1-reg']);
                    $jurado_n2=mainModel::clean_cadn($_POST['Jurado2-reg']);
                    
                                       
                    if($jurado_n1!=""){
                            $consult=mainModel::exe_query_simple("SELECT Cuenta_Acc_cod FROM gp_acc WHERE Cuenta_Acc_cod='$asesor'");
                            $ec = $consult->rowCount();
                    }else{
                            $ec=0;
                    }if($ec>=1){
                            $alert=[
                                "Alerta"=>"simple",
                                "Titulo"=>"Ocurrio un error Inesperado",
                                "Texto"=>"El Grupo ya esta Creado.",
                                "Tipo"=>"error"
                            ];
                        }else{

                            $codigo=mainModel::gen_cod_random("CP",8);
                            $clave=mainModel::encryption($pass1);
                            
                            
                            $data_gp=[
                                "codigo"=>"$codigo",
                                "acuenta"=>"$email",
                                "names"=>"$names",
                                "lastnames"=>"$lastnames",
                                "email"=>"$email@ucatolica.edu.co",
                                "pass"=>"$clave",
                                "estado"=>1,
                                "types"=>"Profesor",
                                "photo"=>""
                            ];
                    
                            $save_acc=mainModel::add_account($data_acc);
                            if($save_acc->rowCount()>=1){
                                $data_adm=[
                                    "gp_gp_cod"=>"",
                                    "gp_acc_cod"=>"$codigo",
                                ];
                                print_r ($data_adm);
                                $save_adm=adminModels::add_coord_model($data_adm);
                                if($save_adm->rowCount()>=1){
                                    $alert=[
                                        "Alerta"=>"clean",
                                        "Titulo"=>"Grupo Creado",
                                        "Texto"=>"El Grupo se registro con Exito!.",
                                        "Tipo"=>"success"
                                    ];
                                }else{
                                    mainModel::delete_account("$codigo");
                                    $alert=[
                                        "Alerta"=>"simple",
                                        "Titulo"=>"Ocurrio un error Inesperado",
                                        "Texto"=>"Los datos de Grupo no se pudieron Registrar.",
                                        "Tipo"=>"error"
                                    ];
                                }
                            }else{
                                $alert=[
                                    "Alerta"=>"simple",
                                    "Titulo"=>"Ocurrio un error Inesperado",
                                    "Texto"=>"El Grupo no se pudo registrar, Verifique nuevamente.",
                                    "Tipo"=>"error"
                                ];
                            }
                        }
                    }
                    return mainModel::sweet_alerts($alert);         
        }
     }   