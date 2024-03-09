<?php
session_start();

require "../../vendor/autoload.php";
require "../../modelos/UsuarioModel.php";

$path = $_SERVER['DOCUMENT_ROOT'];
$dotenv = Dotenv\Dotenv::createMutable($path);
$dotenv->load();


if(isset($_SESSION['id']) && $_SESSION['rol'] == 'admin'){

    $usuarios = UsuarioModel::listarUsuarios();
   
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(0, 10, 'Reporte de Usuarios', 0, 1, 'C');


    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(5, 7, '#', 1, 0, 'C');
    $pdf->Cell(42, 7, 'Nombre', 1, 0, 'C');
    $pdf->Cell(35, 7, 'Paterno', 1, 0, 'C');
    $pdf->Cell(35, 7, 'Materno', 1, 0, 'C');
    $pdf->Cell(50, 7, 'Correo', 1, 0, 'C');
    $pdf->Cell(20, 7, 'Rol', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 10);
    foreach($usuarios as $key => $usuario){
        $pdf->Cell(5, 7, $key+1, 1, 0, 'C');
        $pdf->Cell(42, 7, $usuario['nombre'], 1, 0, 'L');
        $pdf->Cell(35, 7, $usuario['paterno'], 1, 0, 'L');
        $pdf->Cell(35, 7, $usuario['materno'], 1, 0, 'L');
        $pdf->Cell(50, 7, $usuario['usuario'], 1, 0, 'L');
        $pdf->Cell(20, 7, $usuario['rol'], 1, 1, 'C');
    }

    $pdf->Output();

}else{
    header('Location: /');
}


