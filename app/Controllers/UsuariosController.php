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

    //metodo para traer un usuario por id

    public function idUser($id=null){
        $model = new UsuariosModel();
        $datos=$model->getWhere(["id_usuario"=>$id])->getResult();

        if($datos){
            return $this->respond($datos,200);
        }else{
            return $this->failNotFound("Datos no encontrados del id:".$id);
        }
    }
}
?>