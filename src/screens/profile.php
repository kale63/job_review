<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION["user_id"])) {
    $my_sqli = require __DIR__ ."../../../backend/db.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $my_sqli->query($sql);

    $user = $result->fetch_assoc();
}

if(isset($_FILES["fileImg"]["name"])) {
    $id = $_SESSION["user_id"];

    $src = $_FILES["fileImg"]["tmp_name"];
    $imageName = uniqid() . $_FILES["fileImg"]["name"];

    $target = "../img/profile-pics/" . $imageName;

    move_uploaded_file($src, $target);

    $query = "UPDATE user SET image = '$imageName' WHERE id = $user_id";
    mysqli_query($my_sqli, $query);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/morph/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/2a6aa53490.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../styles/style.css"></body></body>
    <title>Mi Perfil</title>
</head>
<body>
    <!--<?php if (isset($user)) : ?>
        <p>Iniciaste sesión!</p>
    <?php else: ?>
        <p><a href="login.php">Inicia sesión</a> o <a href="signup.html">regístrate</a> para ver el contenido.</p>
    <?php endif; ?>-->

    <!-- Navbar -->
    <div class="navbar navbar-expand-lg justify-content-center w-100">
        <nav class="navbar-nav w-100 d-flex flex-row justify-content-around">
            <div class="navbar-icon mx-2">
                <a href="homepage.php"><i class="fa-solid fa-house"></i></a>
            </div>
            <div class="navbar-icon mx-2">
                <a href="../logout.php" class="logout">Cerrar Sesión   <i class="fa-solid fa-right-to-bracket"></i></a>
            </div>
        </nav>
    </div>

    <!-- profile -->
    <div class="pretty-bg mt-5 mb-5">
         <div class="profile-div w-100 d-flex flex-row justify-content-center align-items-start">
            <div class="user-info mx-5 d-flex flex-column col-4 mt-5 justify-content-center align-items-center">
                <div class="profile-pic w-100 mb-5 d-flex justify-content-center align-items-center">
                    <img src="../img/profile-defualt.jpg" class="user-pic rounded-circle w-80" alt="profile picture" id="profilePic">
                </div>
                <div class="username">
                    <h3>Username</h3>
                </div>
                <div class="bio">
                    <h6 class="bio-title">Descripción</h6>
                    <p class="bio-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga laborum fugiat autem facilis asperiores praesentium.</p>
                    <div class="btn-div">
                        <button class="edit-btn btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editing-modal">Editar</button>
                    </div>
                </div>
            </div>
            <div class="user-posts mt-5 d-flex flex-column col-6 justify-content-center align-items-center">
                <div class="posted justify-content-center align-items-center bg-gradient">
                    <h2 class="section-title mt-3 d-flex justify-content-center align-items-center">Mis Publicaciones</h2>
                    <div class="posts">
                        <div id="my-posts" class="p-4 mt-5 d-flex flex-row flex-wrap overflow-y w-100 justify-content-around">
                            <!--Posts-->
                        </div>
                    </div>
                </div>
                <div class="bookmarked mt-4 justify-content-center align-items-center bg-gradient">
                    <h2 class="section-title mt-3 d-flex justify-content-center align-items-center">Publicaciones Guardadas</h2>
                    <div class="posts">
                        <div id="my-bookposts" class="p-4 mt-5 d-flex flex-row flex-wrap w-100 justify-content-around" style="overflow-y: scroll;">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
    <!-- Edición -->
    <div class="modal" id="editing-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div id="current-user" data-id-user="<?php echo $_SESSION['user_id']; ?>"></div>
                <div class="modal-header">
                    <h5 class="modal-title">Editar el Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                    </button>
                </div>
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="modal-body d-flex flex-column col-4 mt-5 justify-content-center align-items-center">
                        <div class="upload">
                            <div class="profile-pic w-100 mb-5 d-flex justify-content-center align-items-center">
                                <img src="../img/profile-defualt.jpg" class="user-pic rounded-circle w-80" alt="profile picture" id="edit-pic">
                            </div>
                            <div class="right d-flex flex-row" id="upload">
                                <input type="file" name="fileImg" id="fileImg" accept=".jpg, .jpeg, .png">
                                <i class="fa-solid fa-camera"></i>
                            </div>
                            <div class="left" id="cancel" style="display: none;">
                                <i class="fa-solid fa-xmark"></i>
                            </div>
                            <div class="right" id="confirm" style="display: none;">
                                <input type="submit" name="" value="">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </div>
                        
                        <!--<div class="username">
                            <label class="edit-label" for="user-edit">Nombre de Usuario</label>
                            <input type="text" name="user-edit" id="user-edit" placeholder="Elige un nuevo nombre de usuario disponible">
                        </div>-->
                        <div class="bio">
                            <label class="edit-label" for="bio-edit">Descripción</label>
                            <input type="text" name="bio-edit" id="bio-edit" placeholder="Escribe una nueva descripción">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-secondary edit-btn">Guardar Cambios</button>
                        <button type="button" class="btn btn-outline-secondary delete-btn" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <!-- Lógica del Frontend -->
    <script src="../app.js"></script>
</body>
</html>