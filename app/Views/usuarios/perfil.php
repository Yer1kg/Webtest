<?php
use App\Libraries\TIPOSUSUARIO; 
?>
<div class="container" style="margin-top:20px;">

    <div class="row">

        <div class="panel panel-primary">

            <div class="panel-body">

                <h3>Hola, <?= $user['nombre'] ?></h3>

                <?php if(session()->get('rol') == TIPOSUSUARIO::USUARIO_ADMIN):?>
                    <h4>Saludos Admin.</h4>
                <?php endif?>

                <hr>
                <p>Email: <?= $user['email'] ?></p>
                <h3><a href="<?= site_url("salir") ?>">Salir</a></h3>
                <h3><a href="<?= site_url("zoo") ?>">Pagina principal</a></h3>

            </div>

        </div>

    </div>

</div>