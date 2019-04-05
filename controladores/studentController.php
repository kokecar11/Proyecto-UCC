<?php

        if($petiAjax){
            require_once "../modelos/studentModels.php";
        }else{
            require_once "./modelos/studentModels.php";
        }   

        class studentController extends studentModels{

            public function add_student_controller(){
                    
                    $stunames=mainModel::clean_cadn($_POST['stu-names-reg']);
                    $stulastnames=mainModel::clean_cadn($_POST['stu-lastnames-reg']);
                    $stuemail=mainModel::clean_cadn($_POST['stu-email-reg']);
                    $stupass1=mainModel::clean_cadn($_POST['stu-password1-reg']);
                    $stupass2=mainModel::clean_cadn($_POST['stu-password2-reg']);
                    if($stupass1!=$stupass2){
                        $stualert=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error Inesperado",
                            "Texto"=>"Las contraseñas no Coinciden, intente nuevamente.",
                            "Tipo"=>"error"
                        ];
                    }else{
                        
                        if($stuemail!=""){
                            $stuconsult=mainModel::exe_query_simple("SELECT Acc_email FROM cuenta WHERE Acc_email='$stuemail@ucatolica.edu.co'");
                            $stuec = $stuconsult->rowCount();
                        }else{
                            $stuec=0;
                        }
                        if($stuec>=1){
                            $stualert=[
                                "Alerta"=>"simple",
                                "Titulo"=>"Ocurrio un error Inesperado",
                                "Texto"=>"El Correo Institucional ya esta Registrado.",
                                "Tipo"=>"error"
                            ];
                        }else{

                            $stucodigo=mainModel::gen_cod_random("CE",8);
                            $stuclave=mainModel::encryption($stupass1);
                            
                            
                            $studata_acc=[
                                "codigo"=>"$stucodigo",
                                "acuenta"=>"$stuemail",
                                "names"=>"$stunames",
                                "lastnames"=>"$stulastnames",
                                "email"=>"$stuemail@ucatolica.edu.co",
                                "pass"=>"$stuclave",
                                "estado"=>1,
                                "types"=>"Estudiante",
                                "photo"=>""
                            ];
                           
                            $stusave_acc=mainModel::add_account($studata_acc);
                            if($stusave_acc->rowCount()>=1){
                                $studata_adm=[
                                    "gp_gp_cod"=>"",
                                    "gp_acc_cod"=>"$stucodigo",
                                ];
                               
                                $stusave_adm=studentModels::add_student_model($studata_adm);
                                if($stusave_adm->rowCount()>=1){
                                    $stualert=[
                                        "Alerta"=>"clean",
                                        "Titulo"=>"Estudiante Registrado",
                                        "Texto"=>"El Estudiante se registro con Exito!.",
                                        "Tipo"=>"success"
                                    ];
                                }else{
                                    mainModel::delete_account("$stucodigo");
                                    $stualert=[
                                        "Alerta"=>"simple",
                                        "Titulo"=>"Ocurrio un error Inesperado",
                                        "Texto"=>"Los datos del Estudiante no se pudieron Registrar.",
                                        "Tipo"=>"error"
                                    ];
                                }
                            }else{
                                $stualert=[
                                    "Alerta"=>"simple",
                                    "Titulo"=>"Ocurrio un error Inesperado",
                                    "Texto"=>"La cuenta no se pudo registrar, Verifique nuevamente.",
                                    "Tipo"=>"error"
                                ];
                            }
                        }
                    }
                     return mainModel::sweet_alerts($stualert);
                
        }
    }   