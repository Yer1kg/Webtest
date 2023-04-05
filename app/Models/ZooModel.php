<?php
namespace App\Models;
use CodeIgniter\Model;

class ZooModel extends Model
{
    
protected $table = 'zoos';
protected $allowedFields = ['nombre', 'ciudad'];

 public function getZoo($id = false)

    {
        
        if ($id === false) {

            return $this->findAll();

        }
        return $this->where(['id' => $id])->first();

    }

   /* public function updateZoo($datos, $idAEditar = false)
    {
        if($idAEditar === false)
        {
            return false;
        }
         $this->update($idAEditar, $datos);
    }
    */

}
?>