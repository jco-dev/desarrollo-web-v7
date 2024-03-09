<?php

class Usuario {

    static public function registroUsuario()
    {
        if(isset($_POST['nombre']) && isset($_POST['paterno']) && isset($_POST['correo']) && isset($_POST['clave']) && isset($_POST['repita_clave']))
        {
            if($_POST['clave'] == $_POST['repita_clave'])
            {
                $datos = [
                    'nombre'    => $_POST['nombre'],
                    'paterno'   => $_POST['paterno'],
                    'materno'   => $_POST['materno'],
                ];

                $id_persona = UsuarioModel::guardarPersona('persona', $datos);

                if($id_persona)
                {
                    $datos = [
                        'id_usuario'    => $id_persona,
                        'usuario'        => $_POST['correo'],
                        'clave'         => password_hash($_POST['clave'], PASSWORD_DEFAULT),
                        'rol'           => 'usuario'
                    ];

                    $respuesta = UsuarioModel::guardarUsuario('usuario', $datos);

                    if($respuesta){
                        $persona = UsuarioModel::obtenerPersona('persona', $id_persona);
                        self::iniciarSesion($persona);
                    }

                    // header('Location: /login');
                    
                }

            }else{
                echo "<div class='alert alert-danger mt-2'>Error de clave<div>";
            }
        }
    }

    static private function iniciarSesion($persona)
    {
        $_SESSION['id'] = $persona['id_persona'];
        $_SESSION['nombre'] = $persona['nombre'];
        $_SESSION['paterno'] = $persona['paterno'];
        $_SESSION['materno'] = $persona['materno'];
        $_SESSION['usuario'] = $persona['usuario'];
        $_SESSION['rol'] = $persona['rol'];

        echo "<script>window.location = '".$_ENV['BASE_URL']."';</script>";
    }


    static public function loginUsuario()
    {
        if(isset($_POST['usuario']) && isset($_POST['clave']) )
        {

            $usuario = UsuarioModel::obtenerUsuario(trim($_POST['usuario']));

            if($usuario){
                if(password_verify($_POST['clave'], $usuario['clave'])){
                    $persona = UsuarioModel::obtenerPersona('persona', $usuario['id_usuario']);
                    self::iniciarSesion($persona);
                }else{
                    echo "<div class='alert alert-danger mt-2'>
                        Usuario no encontrado
                    </div>";
                }

            }else{
                echo "<div class='alert alert-danger mt-2'>
                    Usuario no encontrado
                </div>";
            }


        }
    }

    static public function listarUsuarios()
    {
      
        $usuarios = UsuarioModel::listarUsuarios();
        return $usuarios;
    }

}