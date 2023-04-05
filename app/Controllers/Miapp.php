<?php
namespace App\Controllers;
class Miapp extends BaseController
{
public function getindex()
 {
   $datos['nombre'] = 'Pepon';
   $datos['apellido'] = 'Castillo Tanque';
   echo view('miapp', $datos);
  
 }

 public function getBusca($nada = "por defecto")
 {

        echo ("he ejecutado el método Busca, ha encontrado $nada"); 

 }

 public function getCestanavidad($idecesta, $variante)
 {

        echo ("cesta de navidad su numero $idecesta, con la $variante"); 

 }
}?>
