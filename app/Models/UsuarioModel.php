<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Libraries\TIPOSUSUARIO;

class UsuarioModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ["nombre", "apellidos", "email", "password", "rol"];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ["gestionaTipoUsuario", "hashearPwd"];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ["hashearPwd"];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    protected function hashearPwd(array $data){

        if (isset($data['data']['password'])) {

            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        }
        return $data;

    }

    public function gestionaTipoUsuario(array $data){

        if(!isset($data['data']['rol'])){
      $data['data']['rol'] = TIPOSUSUARIO::USUARIO_NORMAL;
        }
      return $data;

    }

    public function getUsuario($id = false)

    {
        
        if ($id === false) {

            return $this->findAll();

        }
        return $this->where(['id' => $id])->first();

    }

}      


