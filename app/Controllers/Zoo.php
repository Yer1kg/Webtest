<?php namespace App\Controllers;

use App\Models\ZooModel;
use Config\Services;
use mysqli;



Class Zoo extends BaseController {



    /**

     * Ver el listado de todos los zoos

     */

    public function getIndex() {

        return ($this->devolverListadoCompleto());

    }



    /**

     * Ver un solo listado

     */

    public function getVer($id=null) {

        $modelo=model(ZooModel::class);



        if($id===null) {

            echo('Necesito un id de zoológico');

            return;

        }



        $datos['zoo']=$modelo->getZoo($id);

        $datos['titulo']="Datos del zoológico seleccionado";



        if (empty($datos['zoo'])) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException('No encuentro el zoo con id: '. $id);

        }



        $datos['nombre']=$datos['zoo']['nombre'];



        return 

            view('templates/header', $datos) .

            view('zoos/ver_zoo', $datos).

            view('templates/footer');

    }



    /**

     * Creación de un zoológico

     */

    public function getCrear() {

      

        helper('form');

        $datos['titulo']="Crear zoológico";



        return 

            view('templates/header', $datos) .

            view('zoos/crear', $datos) .

            view('templates/footer');

    }



    /**

     * Gestión de la inserción de un zoológico

     */

    public function postIndex() 

    {

        return ($this->validarYGrabar());

    }



    /**

     * Gestión de la modificación de un zoo

     */

    public function postEditar($id)
    {

        return($this->validarYGrabar($id));

    }

  

  


/**

     * Realiza la acción concreta de validad Y GRABAR

     * tanto en un crear (INSERT) como en un actualizar (UPDATE)

     */

    private function validarYGrabar($id = null)

    {

        $modelo=model(ZooModel::class);

        if (

            $this->validate([

                'frm_nombre'=> 'required|min_length[10]|max_length[25]|is_unique[zoos.nombre,nombre,{frm_nombre}]',

                'frm_ciudad'=> 'required'

            ])

            ) {

                $modelo->save([ 

                    'nombre'=> $this->request->getPost('frm_nombre'),

                    'ciudad'=> $this->request->getPost('frm_ciudad'),

                    'id' => isset($id) ? $id : null

                ]);

                

                return 

                    view('templates/header', ['titulo' => 'Éxito al ' . (isset($id) ? 'editar' : 'insertar')]) .

                    view('zoos/exito', ['verbo' => isset($id) ? 'actualizado' : 'creado']).                    

                    view('templates/footer');

        }


        /* SI ESTAMOS AQUÍ ES PORQUE LA VALIDACIÓN QUIERE QUE VOLVAMOS AL FORM */            
        $datos['titulo']="Algo falló al crear/actualizar zoológico";
        helper('form');

        if (isset($id)){

            // hay que recuperar la fila que intentaron actualizar pero cuya validación acaba de fallar

            $zooACorregir = $modelo->getZoo($id);

            return 

                view('templates/header', $datos) .

                view('zoos/editar', ['zoo' => $zooACorregir]) .

                view('templates/footer');

        }else{

            return 

                view('templates/header', $datos) .

                view('zoos/crear') .

                view('templates/footer');

        }

    } 



    /**

     * Borrar zoo

     */

    public function getBorrarzoologico($idABorrar = null) {

        $modelo = model(ZooModel::class);

        $modelo->where('id', $idABorrar)->delete($idABorrar);

        

        return($this->devolverListadoCompleto());

        //CONSEGUIR ARREGLAR redirect('zoo', 'refresh');

    }



    public function getEditar($idAEditar = null)

    {

        $modelo = model(ZooModel::class);

        $zooAEditar = $modelo->getZoo($idAEditar);



        helper('form');

        return 

            view('templates/header', ['titulo'=>'Editar el zoológico ' . $zooAEditar['nombre']]) .

            view('zoos/editar', ['zoo' => $zooAEditar]).

            view('templates/footer');

    }





    public function devolverListadoCompleto()

    {

        

        $modelo=model(ZooModel::class);

        // $datos['zoo'] = $modelo->getZoo();



        $datos=[ 

            'zoo'=>$modelo->getZoo(),

            'titulo'=>'Mi primer listado de Zoos',

        ];

        

        return 

            view('templates/header', $datos) .

            view('zoos/listado_zoos', $datos).

            view('templates/footer');

    }

}



?>