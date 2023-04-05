<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;


class User extends BaseController
{
    public function login(){


        if ($this->request->getMethod() == 'post') {

            $rules = [

                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validarUsuario[email,password]',

            ];

            $errors = [

                'email' => [

                    'required' => 'El correo es requerido',
                    'min_length' => 'Pon un correo más larguito',
                    'max_length' => 'No pongas un correo tan larguito',
                    'valid_email' => 'Aprende a escribir bien un correo'

                ],

                'password' => [

                    'required' => 'El password es requerido',
                    'min_length' => 'Pon un password más larguito',
                    'max_length' => 'No pongas un password tan larguito',
                    'validarUsuario' => "El correo o el password no son correctos",

                ],

            ];

            if (!$this->validate($rules, $errors)) {
   
                return 
                    view('templates/header', array("titulo" => "Error en el login")) .
                    view('usuarios/login', [
                    "validation" => $this->validator,

                ]);

            } else {

                $model = new UsuarioModel();
                $user = $model->where('email', $this->request->getVar('email'))

                    ->first();
                // Stroing session values
                $this->estableceSesion($user);
                // Redirecting to dashboard after login
                return redirect()->to(base_url('perfil'));

            }

        }

        //helper('form');

        //if not post, o sea, es un get, o sea, estamo CARGANDO el login
        $datos['titulo']="Login";
        return 
            view('templates/header', $datos) .
            view('usuarios/login') . 
            view('templates/footer');

    }


    public function listadoCompleto(){
 
        $modelo=model(UsuarioModel::class);

        // $datos['zoo'] = $modelo->getZoo();
        $datos=[ 

            'usuario'=>$modelo->getUsuario(),
            'titulo'=>'Listado de usuarios',

        ];
        return 
            view('templates/header', $datos) .
            view('usuarios/listado_usuarios', $datos).
            view('templates/footer');

    }





    private function estableceSesion($user){

        $data = [

            'id' => $user['id'],
            'name' => $user['nombre'],
            'email' => $user['email'],
            'rol' => $user['rol'],
            'logeado' => true,

        ];
        session()->set($data);
        return true;

    }


    public function register()
    {

        if ($this->request->getMethod() == 'post') {
           //validamos aqui mismo

           $rules = [
                'name' => 'required|min_length[3]|max_length[20]',
                'apellido'=> 'min_length[3]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[usuarios.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'password_confirm' => 'matches[password]',

            ];

            $errocitos = [
                'password'=>['min_length'=>'pon una password mas segura, por favor.'],
                'email'=>['is_unique' => 'el correo debe ser único']

            ];

            if (!$this->validate($rules, $errocitos)) {

                return             

                    view('templates/header', array('titulo' => 'Error en el registro')) .
                    view('usuarios/register', [

                        "resultados_validacion" => $this->validator,

                    ]) .
                    view('templates/footer');

            } else {

                $model = new UsuarioModel();

                $newData = [

                    'nombre' => $this->request->getVar('name'),
                    'apellidos' => $this->request->getVar('apellido'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'rol' => $this->request->getVar('rol'),

                ];

                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Registro exitoso');
                $user=$model->where('email', $this->request->getVar('email'))->first(); 
                $this->estableceSesion($user);
                return redirect()->to(base_url('usuarios'));
            }
        }    
        return 
            view('templates/header', array('titulo' => 'Registro')) .
            view('usuarios/register') . 
            view('templates/footer');

           
    }


    public function mostrarPerfil()
    {

        $data = [];
        $model = new UsuarioModel();

        $data['user'] = $model->where('id', session()->get('id'))->first();
        return
        view('templates/header', array('titulo' => 'Perfil de '.$data['user']['nombre'])) .
        view('usuarios/perfil', $data) . 
        view('templates/footer');

    }

    public function abandonarsesion(){

        session()->destroy();
        return redirect()->to('login');

    }



        /**

     * Ver un solo listado

     */

     public function getVer($id=null) {

        $modelo=model(UsuarioModel::class);



        if($id===null) {

            echo('Necesito un id de usuario');

            return;

        }



        $datos['user']=$modelo->getUsuario($id);

        $datos['titulo']="Datos del usuario seleccionado";



        if (empty($datos['user'])) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException('No encuentro el usuario con id: '. $id);

        }



        $datos['nombre']=$datos['user']['nombre'];



        return 

            view('templates/header', $datos) .

            view('usuarios/ver_usuario', $datos).

            view('templates/footer');

    }



    /**

     * Creación de un usuario

     */

    public function getCrear() {

      

        helper('form');
        $datos['titulo']="Crear usuario";

        return 

            view('templates/header', $datos) .
            view('usuarios/crear', $datos) .
            view('templates/footer');

    }



    /**

     * Gestión de la inserción de un usuario

     */

    public function postIndex() 

    {

        return ($this->validarYGrabar());

    }



    /**

     * Gestión de la modificación de un usuario

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

        $modelo=model(UsuarioModel::class);

        if (

            $this->validate([

                'nombre' => 'required|min_length[3]|max_length[20]',
                'apellidos'=> 'min_length[3]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[usuarios.email,email,{email}]',

            ])

            ) {

                $modelo->save([ 

                    'nombre'=> $this->request->getPost('nombre'),
                    'email'=> $this->request->getPost('email'),
                    'apellidos'=> $this->request->getPost('apellidos'),
                    'rol'=> $this->request->getPost('rol'),
                    'id' => isset($id) ? $id : null

                ]);

                

                return 

                    view('templates/header', ['titulo' => 'Éxito al ' . (isset($id) ? 'editar' : 'insertar')]) .
                    view('usuarios/exito', ['verbo' => isset($id) ? 'actualizado' : 'creado']).                    
                    view('templates/footer');

        }


        /* SI ESTAMOS AQUÍ ES PORQUE LA VALIDACIÓN QUIERE QUE VOLVAMOS AL FORM */            
        $datos['titulo']="Algo falló al crear/actualizar el usuario";
        helper('form');

        if (isset($id)){

            // hay que recuperar la fila que intentaron actualizar pero cuya validación acaba de fallar

            $usuarioACorregir = $modelo->getUsuario($id);

            return 

                view('templates/header', $datos) .
                view('usuarios/editar', ['usuario' => $usuarioACorregir]) .
                view('templates/footer');

        }else{

            return 

                view('templates/header', $datos) .
                view('usuarios/crear') .
                view('templates/footer');

        }

    } 



    /**

     * Borrar usuario

     */

    public function getBorrarusuario($idABorrar = null) {

        $modelo = model(UsuarioModel::class);

        $modelo->where('id', $idABorrar)->delete($idABorrar);

        

        return($this->ListadoCompleto());

        //CONSEGUIR ARREGLAR redirect('zoo', 'refresh');

    }



    public function getEditar($idAEditar = null)

    {

        $modelo = model(UsuarioModel::class);

        $usuarioAEditar = $modelo->getUsuario($idAEditar);



        helper('form');

        return 

            view('templates/header', ['titulo'=>'Editar el usuario ' . $usuarioAEditar['nombre']]) .
            view('usuarios/editar', ['usuario' => $usuarioAEditar]).
            view('templates/footer');

    }








}
