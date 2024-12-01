<?php
namespace Backend\API;

use Backend\API\DataBase;
require_once __DIR__ .'/Database.php';

class Create extends DataBase {

    /*public function __construct($db, $user='root', $pass='gaboas') {
        parent::__construct($db, $user, $pass);
    }*/

    public function __construct($db, $user='root', $pass='gaboas') {
        parent::__construct($db, $user, $pass);
    }

    public function add($jsonOBJ) {
        // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
        $this->data = array(
            'status'  => 'error',
            'message' => 'Ya existe un post con ese nombre'
        );
        if(isset($jsonOBJ->title)) {
            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE AND eliminado = 0
            $sql = "SELECT * FROM post WHERE title = '{$jsonOBJ->title}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
            
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO post VALUES (null, {$jsonOBJ->user}, '{$jsonOBJ->title}', '{$jsonOBJ->company}', {$jsonOBJ->grade}, '{$jsonOBJ->description}', 0)";
                if($this->conexion->query($sql)){
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "El post se ha agregado correctamente";
                } else {
                    $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
            }

            $result->free();
            // Cierra la conexion
            $this->conexion->close();
        }
    }

    public function addBookmark($jsonOBJ) {
        // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
        $this->data = array(
            'status'  => 'error',
            'message' => 'El post ya está guardado'
        );
        if(isset($jsonOBJ)) {
            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE AND eliminado = 0
            $sql = "SELECT * FROM guardado WHERE user_id = {$jsonOBJ->user} AND post_id = {$jsonOBJ->post}";
            $result = $this->conexion->query($sql);
            
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO guardado VALUES ({$jsonOBJ->user}, {$jsonOBJ->post})";
                if($this->conexion->query($sql)){
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "El post se ha guardado correctamente";
                } else {
                    $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
            }

            $result->free();
            // Cierra la conexion
            $this->conexion->close();
        }
    }

    public function SignUp($jsonOBJ){
        
    }
}

//$productos = new Productos();
?>