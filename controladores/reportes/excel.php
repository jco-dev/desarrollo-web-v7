<?php
session_start();

require "../../vendor/autoload.php";
require "../../modelos/UsuarioModel.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$path = $_SERVER['DOCUMENT_ROOT'];
$dotenv = Dotenv\Dotenv::createMutable($path);
$dotenv->load();


if(isset($_SESSION['id']) && $_SESSION['rol'] == 'admin'){

    $usuarios = UsuarioModel::listarUsuarios();

    

    $spreadsheet = new Spreadsheet();
    $activeWorksheet = $spreadsheet->getActiveSheet();

    $activeWorksheet->setTitle('USUARIOS');

    $activeWorksheet->mergeCells('A2:F2')->setCellValue('A2', 'REPORTE DE USUARIOS')
    ->getStyle('A2:F2')->getAlignment()->setHorizontal('center');


    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(18);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(19);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);

    $activeWorksheet->setCellValue('A4', '#');
    $activeWorksheet->setCellValue('B4', 'NOMBRES');
    $activeWorksheet->setCellValue('C4', 'PATERNO');
    $activeWorksheet->setCellValue('D4', 'MATERNO');
    $activeWorksheet->setCellValue('E4', 'CORREO');
    $activeWorksheet->setCellValue('F4', 'ROL');
    
    $contador = 5;
    foreach($usuarios as $key => $usuario){
        $activeWorksheet->setCellValue('A'.$contador, ($key + 1) );
        $activeWorksheet->setCellValue('B'.$contador, $usuario['nombre']);
        $activeWorksheet->setCellValue('C'.$contador, $usuario['paterno']);
        $activeWorksheet->setCellValue('D'.$contador, $usuario['materno']);
        $activeWorksheet->setCellValue('E'.$contador, $usuario['usuario']);
        $activeWorksheet->setCellValue('F'.$contador, $usuario['rol']);
        $contador++;
    }





    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment; filename="reporte.xlsx"');
    $writer->save('php://output');
   

}else{
    header('Location: /');
}


