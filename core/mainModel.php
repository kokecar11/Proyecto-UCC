<?php
    
    if($petiAjax){
        require_once "../core/configAPP.php";

    }else{

        require_once "./core/configAPP.php";
    }   

    class mainModel{
        
        protected function connection(){

            $link = new PDO(GEST_DB,USER,PASSWORD);
            return $link;

        }
        
        protected function exe_query_simple($query){

            $respuesta = self::connection()->prepare($query);
            $respuesta->execute();
            return $respuesta;

        }


        public function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}
		protected function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
        }
        
       /* protected function gen_cod_random($){

        }*/
        protected function clean_cadn($cadena){
            $cadena= trim($cadena); //Quita los espacios en el texto
            $cadena= stripslashes($cadena); //Quita barras invertidas
            $cadena= str_ireplace("<script>","",$cadena);//Quita los espacios despues de una cadena
            $cadena= str_ireplace("</script>","",$cadena);
            $cadena= str_ireplace("<script src","",$cadena);
            $cadena= str_ireplace("SELECT * FROM","",$cadena);
            $cadena= str_ireplace("DELETE FROM","",$cadena);
            $cadena= str_ireplace("INSERT INTO","",$cadena);
            $cadena= str_ireplace("--","",$cadena);
            $cadena= str_ireplace("{","",$cadena);
            $cadena= str_ireplace("}","",$cadena);
            $cadena= str_ireplace("^","",$cadena);
            return $cadena;
        
        }
    
        protected function sweet_alerts($datos){
            if($datos['Alerta']=="simple"){
                $alert_ms="
                    <script>
                        Swal.fire(
                            '".$datos['Titulo']."',
                            '".$datos['Texto']."',
                            '".$datos['Tipo']"'
                        );
                    </script>
                ";
            }elseif($datos['Alerta']=="reload"){
                $alert_ms="
                <script>
                Swal.fire({
                    title: '".$datos['Titulo']."',
                    text: '".$datos['Texto']."',
                    type: '".$datos['Tipo']"',
                    confirmButtonText: 'Aceptar'
                  }).then((result) => {
                    location.reload();
                  })
                </script>
            ";
            }elseif($datos['Alerta']=="clean"){
                $alert_ms="
                <script>
                Swal.fire({
                    title: '".$datos['Titulo']."',
                    text: '".$datos['Texto']."',
                    type: '".$datos['Tipo']"',
                    confirmButtonText: 'Aceptar'
                  }).then((result) => {
                    $('.FormularioAjax')[0].reset();
                  })
                </script>
                ";
            }
            return $alert_ms;   
        }
    
    }