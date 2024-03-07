<?php

require_once 'Conexion.php';

class PreguntaModel{

    static public function listar($tabla, $columna, $valor)
    {
        if($columna == null){
            // todos los datos de la columna
            $stmt = Conexion::conectar()->prepare("SELECT p.*, pe.* FROM $tabla p INNER JOIN usuario u ON p.id_usuario = u.id_usuario INNER JOIN persona pe ON u.id_usuario = pe.id_persona");
            $stmt->execute();
            return $stmt->fetchAll();
        }else{
            // una pregunta
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla p INNER JOIN usuario u ON p.id_usuario = u.id_usuario INNER JOIN persona pe ON u.id_usuario = pe.id_persona  WHERE p.$columna=:$columna");
            $stmt->bindParam(':'.$columna, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch();
        }
    }

    static public function guardar($tabla, $datos)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (titulo, descripcion, imagen, id_usuario) VALUES (:titulo, :descripcion, :imagen, :id_usuario)");
        $stmt->bindParam(':titulo', $datos['titulo'], PDO::PARAM_STR);
        $stmt->bindParam(':descripcion', $datos['descripcion'], PDO::PARAM_STR);
        $stmt->bindParam(':imagen', $datos['imagen'], PDO::PARAM_STR);
        $stmt->bindParam(':id_usuario', $datos['id_usuario'], PDO::PARAM_INT);

        return $stmt->execute();
    }

}