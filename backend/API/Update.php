<?php
namespace Backend\API;

use Backend\API\DataBase;
require_once __DIR__ . '/Database.php';

class Update extends DataBase {

    public function __construct($db, $user='root', $pass='gaboas') {
        parent::__construct($db, $user, $pass);
    }

    public function edit($jsonOBJ) {
        // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló'
        );
        // SE VERIFICA HABER RECIBIDO EL ID
        if( isset($jsonOBJ->id) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql =  "UPDATE post SET  user_id={$jsonOBJ->user}, title='{$jsonOBJ->title}', company='{$jsonOBJ->company}',";
            $sql .= "grade={$jsonOBJ->grade}, description='{$jsonOBJ->description}' WHERE id={$jsonOBJ->id}";
            $this->conexion->set_charset("utf8");
            if ( $this->conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Post actualizado correctamente";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }
}

//$productos = new Productos();
?>