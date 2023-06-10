<?php
namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\PersonasModel;
use CodeIgniter\RESTful\ResourceController;


class PersonasController extends ResourceController{

    use ResponseTrait;

    public function index(){
        $model= new PersonasModel();
        $data= $model->findAll();
        return $this->respond($data,200);
        
    }

    public function indexXid($id=null){
        $model= new PersonasModel();
        $data = $model->getWhere(["id"=>$id])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound("datos no encontrados del id:".$id);
        }
       
    }

    public function insertarPersona(){
        $model = new PersonasModel();

        $data=[
            "nombre"=>$_POST["nombre"],
            "apellidos"=>$_POST["apellidos"],
            "fecha_nac"=>$_POST["fecha_nac"]
        ];

        $datos=$model->insert($data);

        $response=[
            "status"=>200,
            "error"=>null,
            "messages"=>[
                "success"=>"datos insertados correctamente".$datos
            ]
        ];

        return $this->respondCreated($response);
    }

    public function updatePersona($id=null){
        $model= new PersonasModel();

        $json = $this-> request->getJSON();

        if($json){
            $data=[
                "nombre"=>$json->nombre,
                "apellidos"=>$json->apellidos,
                "fecha_nac"=>$json->fecha_nac
            ];
        }else{
            $input = $this->request->getRawInput();
            $data=[
                "nombre"=>$input["nombre"],
                "apellidos"=>$input["apellidos"],
                "fecha_nac"=>$input["fecha_nac"]
            ];
        }

        $model->update($id,$data);

        $response=[
            "status"=>200,
            "error"=>null,
            "messages"=>[
                "success"=>"datos actualizados correctamente"
            ]
        ];

        return $this->respondUpdated($response);
    }

    public function deletePersona($id=null){
        $model=new PersonasModel();

        $datos=$model->find($id);

        if($datos){
            $model->delete($id);
            $response=[
                "status"=>200,
                "error"=>null,
                "message"=>[
                    "datos eliminados correctamente"
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound("datos no encontrados del id".$id);
        }


    }
}

?>