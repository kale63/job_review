<?php
session_start();

if (isset($_SESSION["user_id"])) {
    $my_sqli = require __DIR__ . "../../../backend/API/Database.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $my_sqli->query($sql);

    $user = $result->fetch_assoc();
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
                <a href="profile.php">Cerrar Sesión   <i class="fa-solid fa-right-to-bracket"></i></a>
            </div>
        </nav>
    </div>

    <!-- profile -->
    <div class="pretty-bg mt-5 mb-5">
         <div class="profile-div w-100 d-flex flex-row justify-content-center align-items-center">
            <div class="user-info d-flex flex-column col-4 justify-content-center align-items-center">
                <div class="profile-pic rounded-circle"></div>
                <div class="username">
                    <h3>Username</h3>
                </div>
                <div class="bio">
                    <h6 class="bio-title">Descripción</h6>
                    <p class="bio-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fuga laborum fugiat autem facilis asperiores praesentium.</p>
                    <div class="btn-div">
                        <button class="bio-btn btn">Editar</button>
                    </div>
                </div>
            </div>
            <div class="user-posts mt-5 d-flex flex-column col-6 justify-content-center align-items-center">
                <div class="posted justify-content-center align-items-center">
                    <h2 class="section-title mt-3">Mis Publicaciones</h2>
                    <div class="posts">
                        <div class="p-4 mt-5 d-flex flex-row w-100 justify-content-around">
                            <div class="card bg-secondary mb-3" style="max-width: 31%;">
                                <div class="card-header ">
                                    <h4 class="card-title">Titulo de la Publicacion</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-top d-flex flex-row w-100 justify-content-around">
                                        <h3>4/5</h3>   
                                        <p>Empresa</p>
                                    </div>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <div class="posts-btn-div justify-content-around w-100">
                                        <div class="edit" id="edit-btn">
                                            <button class="btn">Editar</button>
                                        </div>
                                        <div class="delete" id="delete-btn">
                                            <button class="btn">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bookmarked mt-4">
                    <h2 class="section-title mt-3">Publicaciones Guardadas</h2>
                    <div class="posts">
                        <div class="p-4 mt-5 d-flex flex-row w-100 justify-content-around">
                            <div class="card bg-secondary mb-3" style="max-width: 31%;">
                                <div class="card-header ">
                                    <h4 class="card-title">Titulo de la Publicacion</h4>
                                </div>
                                <div class="card-body">
                                    <div class="card-top d-flex flex-row w-100 justify-content-around">
                                        <h3>4/5</h3>   
                                        <p>Empresa</p>
                                    </div>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <div class="bookmark justify-content-end w-100">
                                        <div class="d-none" id="bookmark-empty">
                                            <i class="fa-regular fa-bookmark"></i>
                                        </div>
                                        <div id="bookmark-checked">
                                            <i class="fa-solid fa-bookmark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>  

    <script>
        document.getElementById('bookmark-checked').addEventListener('click', function () {
            document.getElementById('bookmark-empty').classList.toggle('d-none');
            document.getElementById('bookmark-checked').classList.toggle('d-none');
        });
    </script>
</body>
</html>