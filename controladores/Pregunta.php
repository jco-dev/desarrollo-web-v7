<?php

class Pregunta {

    static public function listarPreguntas($tabla, $columna, $valor){
        return PreguntaModel::listar($tabla, $columna, $valor);
    }

}