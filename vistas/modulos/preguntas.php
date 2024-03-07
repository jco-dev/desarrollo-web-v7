<?php
    $preguntas = Pregunta::listarPreguntas('pregunta', null, null);
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
                        <li class="breadcrumb-item">Preguntas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity ">


                                <?php foreach ($preguntas as $key => $pregunta): ?>
                                    <div class="post clearfix">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="<?= $_ENV['BASE_URL']?>vistas/dist/images/user.png" alt="Imagen de usuario">
                                            <span class="username">
                                                <a href="<?= $_ENV['BASE_URL']?>respuesta/<?= $pregunta['id_pregunta'] ?>"><?= $pregunta['titulo'] ?></a>
                                                <p><?= $pregunta['nombre'] . " ". $pregunta['paterno'] ?></p>
                                            </span>
                                            <span class="description">Compartido públicamente - 15/09/2022</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            <?= $pregunta['descripcion'] ?>
                                        </p>

                                    </div>
                               
                                <?php endforeach; ?>

                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-body">

                            <a class="btn btn-primary btn-block" href="<?= $_ENV['BASE_URL'] ?>pregunta">
                                Preguntar
                            </a>


                            <a class="btn btn-primary btn-block" href="<?= $_ENV['BASE_URL'] ?>login">
                                Regístrese o inicie sesión para preguntar
                            </a>

                        </div>
                    </div>

                </div>
                <!-- /.col-md-6 -->
            </div>
        </div>
    </div>
</div>