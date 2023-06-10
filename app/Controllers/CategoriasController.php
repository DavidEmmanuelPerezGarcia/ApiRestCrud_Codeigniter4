<?php
namespace App\Controllers;

use App\Models\CategoriasModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class CategoriasController extends ResourceController{
    use ResponseTrait;

    public function index(){
        $model=new CategoriasModel();
        $data=$model->findAll();

        return $this->respond($data,200);
    }

    public function show($id=null){
        $model= new CategoriasModel();
        $data=$model->getWhere(["id_categoria"=>$id])->getResult();

        if($data==true){
            return $this->respond($data,200);
        }else{
            return $this->failNotFound("Datos no encontrados del id:".$id);
        }
    }

    public function insertCategoria(){
        $data=[
            "nombre"=>$_POST["nombre"],
            "descripcion"=>$_POST["descripcion"]
        ];

        $model= new CategoriasModel();
        $model->insert($data);

        $response=[
            "status"=>201,
            "error"=>null,
            "messages"=>[
                "success"=>"Datos insertados correctamente"
            ]
        ];

        return $this->respondCreated($response,201);
    }

    public function updateCategoria($id=null){
        $json=$this->request->getJSON();

        if($json){
            $datos=[
                "nombre"=>$json->nombre,
                "descripcion"=>$json->descripcion
            ];
        }else{
            $input=$this->request->getRawInput();

            $datos=[
                "nombre"=>$input["nombre"],
                "descripcion"=>$input["descripcion"]
            ];
        }

        $model= new CategoriasModel();
        $model->update($id,$datos);

        $response=[
            "status"=>201,
            "error"=>null,
            "messages"=>[
                "success"=>"Datos actualizados correctamente :3"
            ]
        ];

        return $this->respond($response);
    }


    public function deleteCategoria($id=null){
        $model= new CategoriasModel();

        $datos=$model->find($id);

        if($datos){
            $model->delete($id);

            $response=[
                "status"=>200,
                "error"=>null,
                "messages"=>[
                    "success"=>"Datos elimindos correctamente"
                ]
            ];

            return $this->respond($response);
        }else{
            return $this->failNotFound("Datos no encontrados del id".$id);
        }
    }
}
?>