<?php

use App\Libraries\TIPOSUSUARIO;

$titulo = isset($titulo) ? $titulo : 'Sin título';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="#">Mi aplicación</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

            <span class="navbar-toggler-icon"></span>

        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item">

                    <a class="nav-link" href="<?= site_url("zoo") ?>">Zoos</a>

                </li>

                <?php if (session()->get('rol') == TIPOSUSUARIO::USUARIO_ADMIN) : ?>
                    <li class="nav-item">

                        <a class="nav-link" href="<?= site_url("usuarios") ?>">Usuarios</a>

                    </li>
                <?php endif ?>

                <?php if (null !== session()->get('id')) : ?>


                    <li class="nav-item">

                        <a class="nav-link" href="<?= site_url("salir") ?>">Cerrar sesión</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="<?= site_url("perfil") ?>">Perfil</a>

                    </li>

                <?php else : ?>

                    <li class="nav-item">

                        <a class="nav-link" href="<?= site_url("login") ?>"> Iniciar sesión</a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="<?= site_url("registrar") ?>">Registrar</a>

                    </li>

                <?php endif ?>



            </ul>



        </div>

    </nav>


    <div class="container py-5">

        <!-- ENCABEZADO COMÚN -->
        <div class="row text-center mb-5">
            <div class="col-lg-7 mx-auto">
                <h1 class="display-4"><?= esc($titulo) ?></h1>
            </div>
        </div>