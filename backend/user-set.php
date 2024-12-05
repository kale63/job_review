<?php
    use Backend\API\User;
    require_once __DIR__.'/vendor/autoload.php';

    $jsonOBJ = [
        'id' => $_POST['id']
    ];

    if(isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK){
        $ruta = '/opt/lampp/htdocs/proyecto-tecweb/job_review/src/img/';
        //$nombeimg = $_FILES['file']['name'];
        $nombeimg = uniqid() . "_" . $_FILES['file']['name'];
        if(($_FILES['file']['type'] == "image/jpg")
            || ($_FILES['file']['type'] == "image/jpeg")
            || ($_FILES['file']['type'] == "image/png")
            || ($_FILES['file']['type'] == "image/gif")){
                
            move_uploaded_file($_FILES['file']['tmp_name'], $ruta.$nombeimg);
            
            $jsonOBJ['image'] = $nombeimg;
        }else{
            $data = array(
                'status'  => 'error',
                'message' => 'Archivo no válido'
            );
            echo $data;
        }
    }

    if(isset($_POST['bio'])){
        $jsonOBJ['bio'] = $_POST['bio'];
    }

    if(isset($jsonOBJ['image']) || isset($jsonOBJ['bio'])){
        $posts = new User('marketzone');
        $posts->updateProfile($jsonOBJ);
        echo $posts->getData();
    }else{
        $data = array(
            'status'  => 'error',
            'message' => 'Sin cambios'
        );
        echo $data;
    }
?>  