<?php

// var_dump($_SESSION);

if ($_SESSION['rol'] == 'usuario') {
    echo "<script>window.location = '" . $_ENV['BASE_URL'] . "';</script>";
}

$personas = Usuario::listarUsuarios();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inicio <small></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                        <li class="breadcrumb-item">Personas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-start">
                                <form action="<?= $_ENV['BASE_URL'] ?>controladores/reportes/pdf.php" method='post' target='_blank'>
                                    <button class="btn btn-danger" type="submit">
                                        <i class='fa fa-file-pdf'></i>
                                        Exportar PDF
                                    </button>
                                </form>
                                &nbsp;
                                <form action="<?= $_ENV['BASE_URL'] ?>controladores/reportes/excel.php" method='post' target='_blank'>
                                    <button class="btn btn-success" type="submit">
                                        <i class='fa fa-file-excel'></i>
                                        Exportar Excel
                                    </button>
                                </form>
                            </div>
                            <table class="table table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>nombre</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>Correo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($personas as $key => $persona) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $persona['nombre'] ?></td>
                                            <td><?= $persona['paterno'] ?></td>
                                            <td><?= $persona['materno'] ?></td>
                                            <td><?= $persona['usuario'] ?></td>
                                            <td>
                                                <a href="<?= $_ENV['BASE_URL'] ?>editar/<?= $persona['id_persona'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                                <a href="<?= $_ENV['BASE_URL'] ?>eliminar/<?= $persona['id_persona'] ?>" class="btn btn-danger btn-sm">Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
</div>