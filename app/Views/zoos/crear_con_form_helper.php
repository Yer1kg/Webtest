<?php



echo "<h2>" . esc($titulo) ."</h2>";



/* Gestión de validación */

session()->getFlashdata('error') ;

service('validation')->listErrors() ;



/* Inicio del formulario */

echo form_open('/zoo', null, ['secreto1'=>'valor1']);

    echo csrf_field() ;

    echo form_label('Nombre', 'frm_nombre');

    echo form_input([

        'name'          => 'frm_nombre',

        'placeholder'   => 'Introduce un nombre'

    ]); 

    echo "<br />";

    echo form_label('Introduce ciudad', 'frm_ciudad');

    echo form_input([

        'name'          => 'frm_ciudad',

        'placeholder'   => 'Introduce ciudad'

    ]);

    echo "<br />";



    /* Botonera final */

    echo form_reset('reset', 'Borrar formulario');

    echo form_submit('submit', 'Guardar zoo!');



echo form_close('<!--fin del formulario de zoológicos-->');

?>

