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

    //metodo para insertar usuarios
    public function insertUsuarios(){
        $datos=[
            "nombre"=>$_POST["nombre"],
            "contraseña"=>sha1($_POST["contraseña"])
        ];

        $model=new UsuariosModel();
        $model->insert($datos);

        $reponse=[
            "status"=>200,
            "error"=>null,
            "messages"=>[
                "success"=>"Datos insertados correctamente"
            ]
        ];

        return $this->respondCreated($reponse,200);
    }

    //metodo para actualizar
    public function updateUsuario($id=null){
        $model= new UsuariosModel();
        $json=$this->request->getJSON();

        if($json){

            $datos=[
                "nombre"=>$json->nombre,
                "contraseña"=>$_POST($json->contraseña)
            ];
        }else{
            $input =$this->request->getRawInput();
            $datos=[
                "nombre"=>$input["nombre"],
                "contraseña"=>sha1($input["contraseña"])
            ];
        }

        $model->update($id,$datos);
        $reponse=[
            "status"=>200,
            "error"=>null,
            "messages"=>[
                "success"=>"Datos actualizados :)"
            ]
        ];

        return $this->respond($reponse,200);

    }
}
?>