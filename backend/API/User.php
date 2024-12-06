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

    public function login($email,$password){
        $this->data = array(
            'status'  => 'error',
            'message' => 'La consulta falló',
        );
        if(isset($email) && isset($password)){
            $sql = sprintf("SELECT * FROM user WHERE email = '%s'",
                        $this->conexion->real_escape_string($email));
        
            $result = $this->conexion->query($sql);

            $user = $result->fetch_assoc();
            
            if ($user) {
                if(password_verify($password, $user["password"])) {
                    session_regenerate_id(true);
                    session_start();
                    $_SESSION["user_id"] = $user["id"];
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "Sesión iniciada correctamente";
                }
            }
        }
    }

    public function signUp($jsonOBJ){
        $this->data = array(
            'status'  => 'error',
            'message' => 'Ya existe un post con ese nombre'
        );
        if(isset($jsonOBJ->email)){

            $sql = "SELECT * FROM user WHERE email = '{$jsonOBJ->email}'";
            $result = $this->conexion->query($sql);
            
            if ($result->num_rows == 0) {
                $password_hash = password_hash($jsonOBJ->password, PASSWORD_DEFAULT);

                $sql  = "INSERT INTO user (username, email, password)
                        VALUES (?, ?, ?)";

                $stmt = $this->conexion->stmt_init();

                if ( ! $stmt->prepare($sql)) {
                    die("SQL Error: " . $this->conexion->error);
                }

                $stmt->bind_param("sss", $jsonOBJ->username, $jsonOBJ->email,  $password_hash);


                if ($stmt->execute()) {
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "El usuario se ha agregado correctamente";
                } else {
                    $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
            }else{
                $this->data['message'] =  "El correo electrónico ya está registrado";
            }
        }
    }

    public function verifyUE($campo, $val) {
        $this->data = array(
            'status'  => 'succes',
            'message' => "{$campo} sin registrar"
        );
        if( isset($val) ) {
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "SELECT * FROM user WHERE {$campo} = '{$val}'";
            if ( $result = $this->conexion->query($sql) ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(count($rows) > 0) {
                    $this->data['status'] = 'error';
                    $this->data['message'] = "Ese {$campo} ya está registrado";
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

}