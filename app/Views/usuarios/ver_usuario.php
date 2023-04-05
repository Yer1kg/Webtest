<?php
use App\Libraries\TIPOSUSUARIO; 
?>
<div class="container" style="margin-top:20px;">

    <div class="row">

        <div class="panel panel-primary">

            <div class="panel-body">

                <h3>Usuario: <?= $user['nombre'] ?></h3>

                <hr>
                <p>Email: <?= $user['email'] ?></p>
                <p>Nombre: <?= $user['nombre'] ?></p>
                <p>Apellidos: <?= $user['apellidos'] ?></p>
                <p>Rol: <?= array_search($user['rol'], TIPOSUSUARIO::$tipos) ?></p>


                <h3><a href="<?= site_url("usuarios") ?>">Salir</a></h3>
               

            </div>

        </div>

    </div>

</div>