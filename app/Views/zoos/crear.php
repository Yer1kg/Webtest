<?php
/* Gestión de validación */
session()->getFlashdata('error') ;
service('validation')->listErrors() ;
echo service('validation')->listErrors() ;
echo anchor('zoo', 'Volver al listado', 'title="haga click aquí para volver al listado"');
?>


<div class="container px-5 my-5">

    <?= form_open('/Zoo');?>
    <?= csrf_field()?>

        <div class="form-floating mb-3">

            <input class="form-control" name="frm_nombre" type="text" placeholder="nombre"  />

            <label for="Nombre">Nombre</label>

        </div>

        <div class="form-floating mb-3">

            <input class="form-control" name="frm_ciudad" type="text" placeholder="ciudad"  />

            <label for="Ciudad">Ciudad</label>

            

        </div>        

        <div class="d-grid">

            <button class="btn btn-primary" id="submitButton" type="submit">Enviar</button>

        </div>
        

    <?= form_close('<!--fin del formulario de zoológicos-->');?>

</div>