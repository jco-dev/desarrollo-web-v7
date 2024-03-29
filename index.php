<?php

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createMutable(__DIR__);
$dotenv->load();

require_once 'controladores/VistaPrincipal.php';
require_once 'controladores/Pregunta.php';
require_once 'controladores/Respuesta.php';
require_once 'controladores/Usuario.php';


require_once 'modelos/PreguntaModel.php';
require_once 'modelos/RespuestaModel.php';
require_once 'modelos/UsuarioModel.php';


$vista = new VistaPrincipal();
$vista->cargarVista();