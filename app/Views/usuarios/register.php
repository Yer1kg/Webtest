<?php

use App\Libraries\TIPOSUSUARIO;
?>
<div class="container" style="margin-top:20px;">

    <div class="row">

        <div class="panel panel-primary">

            <div class="panel-body">

                <?php if (isset($resultados_validacion)) : ?>

                    <div class="col-12">

                        <div class="alert alert-danger" role="alert">

                            <?= $resultados_validacion->listErrors() ?>

                        </div>

                    </div>

                <?php endif; ?>

                <form class="" action="<?= base_url('registrar') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="form-group">

                        <label for="name">Nombre</label>

                        <input type="text" class="form-control" name="name" id="name">

                    </div>


                    <div class="form-group">

                        <label for="name">Apellido</label>

                        <input type="text" class="form-control" name="apellido" id="apellido">

                    </div>

                    <div class="form-group">

                        <label for="email">Email</label>

                        <input type="email" class="form-control" name="email" id="email">

                    </div>

                    <?php
                    if (

                        session()->get('rol') == TIPOSUSUARIO::USUARIO_ADMIN

                    ) : ?>
                        <label for="rol">Rol de este usuario</label>
                        <select name="rol" id="rol" class="form-select" aria-label="Default select example">
                            <option value="<?= TIPOSUSUARIO::USUARIO_ADMIN ?>">Administrador</option>
                            <option value="<?= TIPOSUSUARIO::USUARIO_NORMAL ?>">Usuario normal</option>
                        </select>
                    <?php endif ?>


                    <div class="form-group">

                        <label for="password">Password</label>

                        <input type="password" class="form-control" name="password" id="password">

                    </div>

                    <div class="form-group">

                        <label for="password_confirm">Repetir Password</label>

                        <input type="password" class="form-control" name="password_confirm" id="password_confirm">

                    </div>

                    <button type="submit" class="btn btn-success">Enviar</button>

                </form>

            </div>

        </div>

    </div>

</div>