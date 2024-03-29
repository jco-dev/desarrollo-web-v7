<?php

require_once 'Conexion.php';

class UsuarioModel{

   static public function guardarPersona($tabla, $datos)
   {
        $sql = "INSERT INTO $tabla (nombre, paterno, materno) VALUES (:nombre, :paterno, :materno)";

        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
    
        $stmt->bindParam(':nombre', $datos['nombre'], PDO::PARAM_STR);
        $stmt->bindParam(':paterno', $datos['paterno'], PDO::PARAM_STR);
        $stmt->bindParam(':materno', $datos['materno'], PDO::PARAM_STR);
    
        if($stmt->execute())
        {
             return $con->lastInsertId();
        }else{
             return false;
        }
    
        $stmt->close();
        $stmt = null;
   }

   static public function guardarUsuario($tabla, $datos)
   {
    $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_usuario, usuario, clave, rol) VALUES (:id_usuario, :usuario, :clave, :rol)");
    $stmt->bindParam(':id_usuario', $datos['id_usuario'], PDO::PARAM_INT);
    $stmt->bindParam(':usuario', $datos['usuario'], PDO::PARAM_STR);
    $stmt->bindParam(':clave', $datos['clave'], PDO::PARAM_STR);
    $stmt->bindParam(':rol', $datos['rol'], PDO::PARAM_STR);
    return $stmt->execute();
   }

   static public function obtenerPersona($tabla, $id)
   {
    $stmt = Conexion::conectar()->prepare("SELECT * FROM persona p INNER JOIN usuario u ON p.id_persona = u.id_usuario WHERE p.id_persona = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
   }

   static public function obtenerUsuario($usuario)
   {
     $stmt = Conexion::conectar()->prepare("SELECT * FROM usuario WHERE usuario = :usuario");
     $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
     $stmt->execute();
     return $stmt->fetch();
   }

   static public function listarUsuarios()
   {
     $stmt = Conexion::conectar()->prepare("SELECT * FROM persona p INNER JOIN usuario u ON p.id_persona = u.id_usuario");
     $stmt->execute();
     return $stmt->fetchAll();
   }

}