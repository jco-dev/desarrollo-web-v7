<?php
if (!isset($_SESSION['id'])) {
    echo "<script>window.location = '" . $_ENV['BASE_URL'] . "login';</script>";
}

$preguntas = Pregunta::listarPreguntasUsuario();
$respuestas = Respuesta::listarRespuestasUsuario();

?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perfil<small></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="perfil">Inicio</a></li>
                        <li class="breadcrumb-item">Perfil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="vistas/dist/images/user.png" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= $_SESSION['nombre'] . ' '. $_SESSION['paterno']. ' ' . $_SESSION['paterno']?></h3>

                        <p class="text-muted text-center"><?= $_SESSION['usuario']?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Preguntas</b> <a class="float-right"><?= count($preguntas)?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Respuestas</b> <a class="float-right"><?= count($respuestas) ?></a>
                            </li>

                        </ul>

                        <!-- <a href="#" class="btn btn-primary btn-block"><b>Editar</b></a> -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class=" p-2 d-flex justify-content-between">

                        <h2>Preguntas Posteadas</h2>
                        <a href="<?= $_ENV['BASE_URL']?>pregunta" class="btn btn-primary ">Formular Pregunta</a>
                    </div>
                    <hr>
                    <div class="card-body">

                        <?php if(count($preguntas) > 0): ?>
                        <?php foreach($preguntas as $pregunta): ?>
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="<?= $_ENV['BASE_URL']?>vistas/dist/images/user.png" alt="user image">
                                <span class="username">
                                    <a href="<?= $_ENV['BASE_URL']?>respuesta/<?= $pregunta['id_pregunta'] ?>"><?= $pregunta['titulo'] ?></a>
                                </span>
                                <span class="description">Publicado - <?= $pregunta['fecha_registro'] ?></span>
                            </div>
                            <!-- /.user-block -->
                            <p>

                                <?= $pregunta['descripcion']?>
                            </p>

                            <p>
                                <a href="#" class="link-black text-sm">
                                    <i class="far fa-comments mr-1"></i> Respuestas (<?= $pregunta['cantidad']?>)
                                </a>

                            </p>

                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <!-- mensaje sinpreguntas -->
                        <div class="post">

                            <p>Sin Preguntas Posteadas</p>

                        </div>
                        <!-- mensaje sinpreguntas -->
                        <?php endif; ?>



                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>
</div>