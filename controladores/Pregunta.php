<?php

class Pregunta {

    static public function listarPreguntas($tabla, $columna, $valor){
        return PreguntaModel::listar($tabla, $columna, $valor);
    }

    static public function guardarPregunta()
    {
        if(isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_FILES['foto'])){
            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];

            if(self::validarEntrada($titulo) && self::validarEntrada($descripcion))
            {
                $directorio = "vistas/upload/pregunta/";
                $archivo = $directorio . time() . ".". pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);

                if(move_uploaded_file($_FILES['foto']['tmp_name'], $archivo)){
                    $datos = [
                        'titulo'        => $titulo,
                        'descripcion'   => $descripcion,
                        'imagen'        => $archivo,
                        'id_usuario'    => $_SESSION['id']
                    ];
                    $respuesta = PreguntaModel::guardar('pregunta', $datos);

                    if($respuesta){
                        echo "<script>
                            let mensaje = 'Pregunta guardado correctamente';
                            if(confirm(mensaje)){
                                window.location = 'preguntas';
                            }
                        </script>";
                    }else{
                        echo "<script>
                            alert('Error: No se pudo guardar la pregunta');
                        </script>";
                    }
                }else{
                    echo "<script>
                        alert('Error: No se pudo guardar la imagen');
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

    static public function listarPreguntasUsuario(){
        return PreguntaModel::listarPreguntasUsuario();
    }

}