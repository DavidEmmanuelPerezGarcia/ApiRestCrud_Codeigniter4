<?php
namespace App\Controllers;

use App\Models\UsuariosModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class UsuariosController extends ResourceController{
    use ResponseTrait;

    //metodo para mostrar todos los usuarios

    public function index(){
        $model=new UsuariosModel();
        $datos=$model->findAll();

        return $this->respond($datos,200);
    }
}
?>