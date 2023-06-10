<?php
namespace App\Models;
use CodeIgniter\Model;

class PersonasModel extends Model{
    protected $table="personas";
    protected $primaryKey="id";
    protected $allowedFields=[
        "nombre",
        "apellidos",
        "fecha_nac"
    ];
}
?>