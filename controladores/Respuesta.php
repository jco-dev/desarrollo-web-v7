<?php

class Respuesta {


    static public function listarRespuestas($tabla, $columna, $valor){
        return RespuestaModel::listar($tabla, $columna, $valor);
    }

    static public function guardarRespuesta()
    {
        if(isset($_POST['descripcion'])){
            $descripcion = trim($_POST['descripcion']);

            if(self::validarEntrada($descripcion))
            {

                $ruta = NULL;

                if(isset($_FILES['foto']) && $_FILES['foto']['name'] != ""){
                    $directorio = "vistas/upload/respuesta/";
                    $ruta = $directorio . time() . ".". pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);
                }

                $datos = [
                    'descripcion'   => $descripcion,
                    'id_usuario'    => 1,
                    'id_pregunta'   => $_POST['id_pregunta'],
                    'imagen'        => $ruta
                ];

                $respuesta = RespuestaModel::guardar('respuesta', $datos);
                $ruta = $_ENV['BASE_URL'].'respuesta/'.$_POST['id_pregunta'];

                if($respuesta){
                    echo "<script>
                        let mensaje = 'Respuesta guardada correctamente';
                        if(confirm(mensaje)){
                            window.location = '".$ruta."';
                        }
                    </script>";
                }else{
                    echo "<script>
                        alert('Error: No se pudo guardar la respuesta');
                    </script>";
                }

            }else{
                echo "<script>
                    alert('Error: No se permiten caracteres especiales');
                </script>";
            }
                

        }
        
    }

    static private function validarEntrada($input){
        return preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓ¡Ú¿?!,. ]+$/', $input);
    }

}