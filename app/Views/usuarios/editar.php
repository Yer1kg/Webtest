<?php
/* Gestión de validación */

use App\Libraries\TIPOSUSUARIO;

session()->getFlashdata('error');
service('validation')->listErrors();
echo service('validation')->listErrors();
echo anchor('usuarios', 'Volver al listado', 'title="haga click aquí para volver al listado"');
?>


<div class="container px-5 my-5">

    <?= form_open('/usuarios/editar/' . $usuario['id']); ?>
    <?= csrf_field() ?>

    <div class="form-floating mb-3">

        <input class="form-control" name="nombre" type="text" placeholder="nombre" value="<?= $usuario['nombre'] ?>" />

        <label for="Nombre">Nombre</label>

    </div>

    <div class="form-floating mb-3">

        <input class="form-control" name="apellidos" type="text" placeholder="apellidos" value="<?= $usuario['apellidos'] ?>" />

        <label for="apellidos">Apellidos</label>

    </div>

    <div class="form-floating mb-3">

        <input class="form-control" name="email" type="text" placeholder="email" value="<?= $usuario['email'] ?>" />

        <label for="email">Email</label>

    </div>

    <div class="form-floating mb-3">
        <select name="rol" id="rol" class="form-select" aria-label="">

                    <option value="<?= TIPOSUSUARIO::USUARIO_ADMIN?>" <?php echo $usuario['rol'] == TIPOSUSUARIO::USUARIO_ADMIN ? "selected" : "" ?>>Administrador</option>

                    <option value="<?= TIPOSUSUARIO::USUARIO_NORMAL?>" <?php echo $usuario['rol'] == TIPOSUSUARIO::USUARIO_NORMAL ? "selected" : "" ?>>Usuario normal</option>

        </select>
    </div>


    <div class="d-grid">

        <button class="btn btn-primary" id="submitButton" type="submit">Modificar usuario</button>

    </div>



    <?= form_close('<!--fin del formulario de usuarios-->'); ?>

</div>