<?php

require_once 'Conexion.php';

class RespuestaModel{

    static public function listar($tabla, $columna, $valor)
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM respuesta r INNER JOIN usuario u ON r.id_usuario = u.id_usuario INNER JOIN persona pe on u.id_usuario= pe.id_persona WHERE r.$columna = :$columna");
        $stmt->bindParam(":$columna", $valor, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    static public function guardar($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion, id_usuario, id_pregunta, imagen) VALUES(:descripcion, :id_usuario, :id_pregunta, :imagen)");
        $stmt->bindParam(":descripcion", $datos['descripcion'], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario", $datos['id_usuario'], PDO::PARAM_INT);
        $stmt->bindParam(":id_pregunta", $datos['id_pregunta'], PDO::PARAM_INT);
        $stmt->bindParam(":imagen", $datos['imagen'], PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    static public function listarRespuestasUsuario()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * from respuesta where id_usuario = :id_usuario");
        $stmt->bindParam(':id_usuario', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}