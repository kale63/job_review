<?php
namespace Backend\API;

use Backend\API\DataBase;
require_once __DIR__ . '/Database.php';

class User extends Database{

    public function __construct($db, $user='root', $pass='gaboas') {
        parent::__construct($db, $user, $pass);
    }
    
    public function getProfile($user){
        if(isset($user)){
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT username, image, info FROM user WHERE id = {$user}") ) {
                // SE OBTIENEN LOS RESULTADOS
                $row = $result->fetch_assoc();
    
                if(!is_null($row)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($row as $key => $value) {
                        $this->data[$key] = $value;
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function updateProfile($jsonOBJ){
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló',
            'id' => $jsonOBJ['id'],
            'bio' => $jsonOBJ['bio'],
            'image' => $jsonOBJ['image'],
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($jsonOBJ['id']) ) {
            $elementQuery = [];

            if(isset($jsonOBJ['image'])){
                $elementQuery[] = "image = '{$jsonOBJ['image']}'";
            }

            if(isset($jsonOBJ['bio'])){
                $elementQuery[] = "info = '{$jsonOBJ['bio']}'";
            }

            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql =  "UPDATE user SET ".implode(", ", $elementQuery)." WHERE id = {$jsonOBJ['id']}";
            echo "Consulta SQL: $sql";
            
            $this->conexion->set_charset("utf8");
            if ( $this->conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Perfil actualizado correctamente";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

}