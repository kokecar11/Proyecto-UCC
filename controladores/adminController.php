<?php

        if($petiAjax){
            require_once ("../modelos/adminModels.php");
        }else{
            require_once ("./modelos/adminModels.php");
        }   

        class adminController extends adminModels{
                //Controlador para Registrar un Profesor
            public function add_coord_controller(){
                    
                    $names=mainModel::clean_cadn($_POST['names-reg']);
                    $lastnames=mainModel::clean_cadn($_POST['lastnames-reg']);
                    $email=mainModel::clean_cadn($_POST['email-reg']);
                    $pass1=mainModel::clean_cadn($_POST['password1-reg']);
                    $pass2=mainModel::clean_cadn($_POST['password2-reg']);
                    if($pass1!=$pass2){
                        $alert=[
                            "Alerta"=>"simple",
                            "Titulo"=>"Ocurrio un error Inesperado",
                            "Texto"=>"Las contraseñas no Coinciden, intente nuevamente.",
                            "Tipo"=>"error"
                        ];
                    }else{
                        
                        if($email!=""){
                            $consult=mainModel::exe_query_simple("SELECT Acc_email FROM cuenta WHERE Acc_email='$email@ucatolica.edu.co'");
                            $ec = $consult->rowCount();
                        }else{
                            $ec=0;
                        }
                        if($ec>=1){
                            $alert=[
                                "Alerta"=>"simple",
                                "Titulo"=>"Ocurrio un error Inesperado",
                                "Texto"=>"El Correo Institucional ya esta Registrado.",
                                "Tipo"=>"error"
                            ];
                        }else{

                            $codigo=mainModel::gen_cod_random("CP",8);
                            $clave=mainModel::encryption($pass1);
                            
                            
                            $data_acc=[
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
                            
                                $save_adm=adminModels::add_coord_model($data_adm);
                                if($save_adm->rowCount()>=1){
                                    $alert=[
                                        "Alerta"=>"clean",
                                        "Titulo"=>"Profesor Registrado",
                                        "Texto"=>"El Profesor se registro con Exito!.",
                                        "Tipo"=>"success"
                                    ];
                                }else{
                                    mainModel::delete_account("$codigo");
                                    $alert=[
                                        "Alerta"=>"simple",
                                        "Titulo"=>"Ocurrio un error Inesperado",
                                        "Texto"=>"Los datos de Profesor no se pudieron Registrar.",
                                        "Tipo"=>"error"
                                    ];
                                }
                            }else{
                                $alert=[
                                    "Alerta"=>"simple",
                                    "Titulo"=>"Ocurrio un error Inesperado",
                                    "Texto"=>"La cuenta no se pudo registrar, Verifique nuevamente.",
                                    "Tipo"=>"error"
                                ];
                            }
                        }
                    }
                     return mainModel::sweet_alerts($alert);
                
        }



        //Controlador para Paginar 

        public function pag_admin_controller($pag,$reg,$codd){

            $pag=mainModel::clean_cadn($pag);
            $reg=mainModel::clean_cadn($reg);
        
            $codd=mainModel::clean_cadn($codd);
            $table="";

            $pag= (isset($pag)&& $pag>0) ? (int)$pag:1;
            $initpg=($pag>0) ? (($pag*$reg)-$reg): 0;

            $connect=mainModel::connection();

            $datas=$connect->query("SELECT SQL_CALC_FOUND_ROWS Acc_cod,Acc_names,Acc_lastnames,Acc_email FROM cuenta 
                                WHERE Acc_cod!='$codd' ORDER BY Acc_names ASC LIMIT $initpg,$reg");

            $datas=$datas->fetchAll();

            $total=$connect->query("SELECT FOUND_ROWS()");
            $total=(int)$total->fetchColumn(); 
            
            $Npag=ceil($total/$reg);

            $table.=' <div class="table-responsive">
                            <table class="table table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center">CODIGO</th>
                                        <th class="text-center">NOMBRES</th>
                                        <th class="text-center">APELLIDOS</th>
                                        <th class="text-center">CORREO</th>
                                        <th class="text-center">A. CUENTA</th>
                                        <th class="text-center">A. DATOS</th>
                                        <th class="text-center">ELIMINAR</th>
                                    </tr>
                                </thead>
                            <tbody>
            ';

            if($total>=1&&$pag<=$Npag){
                $cont=$initpg+1;
                foreach($datas as $rows){

                    $table.='
                        <tr>
                            <td>'.$rows['Acc_cod'].'</td>
                            <td>'.$rows['Acc_names'].'</td>
                            <td>'.$rows['Acc_lastnames'].'</td>
                            <td>'.$rows['Acc_email'].'</td>
                        
                            <td>
                                <a href="#!" class="btn btn-success btn-raised btn-xs">
                                    <i class="zmdi zmdi-refresh"></i>
                                </a>
                            </td>
                            <td>
                                <a href="#!" class="btn btn-success btn-raised btn-xs">
                                    <i class="zmdi zmdi-refresh"></i>
                                </a>
                            </td>
                            <td>
                                <form>
                                    <button type="submit" class="btn btn-danger btn-raised btn-xs">
                                        <i class="zmdi zmdi-delete"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    ';
                    $cont++;
                }

            }else{
                $table.='
                    <tr>
                        <td colspan="4">No hay Registros!</td>
                    </tr>
                ';
            }


            $table.=' </tbody> </table> </div>';

            return $table;


        }


        public function data_admin_controller($tipo,$codigo_admn){
            $codigo_admn=mainModel::decryption($codigo_admn);
            $tipo=mainModel::clean_cadn($codigo_admn);

            return adminModels::data_coord_model($tipo,$codigo_admn);

        }



    }   