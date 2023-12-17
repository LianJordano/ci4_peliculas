<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["usuario","email","contrasena"];


    public function contrasenaHash($contrasena){
        return password_hash($contrasena, PASSWORD_DEFAULT);
    }

    public function contrasenaVerificar($contrasena,$contrasenaHash){
        return password_verify($contrasena,$contrasenaHash);
    }

}
