<?php
namespace App\Controllers;

use App\Models\ArticulosModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class ArticulosController extends ResourceController{
    use ResponseTrait;

    //metodo traer todos los articulos
    public function index(){
        $model=new  ArticulosModel();
        $datos=$model->findAll();
        return $this->respond($datos,200);
    }
}

?>