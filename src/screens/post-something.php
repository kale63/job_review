<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}
if (isset($_SESSION["user_id"])) {
    $my_sqli = require __DIR__ . "../../../backend/API/Database.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
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
    <link rel="stylesheet" href="../styles/style.css"></body>
    <title>Publicar Algo</title>
</head>
<body>
    <!--<?php if (isset($_SESSION["user_id"])) : ?>
        <p>Iniciaste sesión!</p>
        <?php else: ?>
        <p><a href="login.php">Inicia sesión</a> o <a href="signup.html">regístrate</a> para ver el contenido.</p>
    <?php endif; ?>-->
    
    <!-- Navbar -->
    <div class="navbar navbar-expand-lg justify-content-center w-100">
        <nav class="navbar-nav d-flex flex-row align-items-center">
            <div class="navbar-icon mx-2">
                <a href="homepage.php"><i class="fa-solid fa-house"></i></a>
            </div>
            <div class="navbar-icon mx-2">
                <a href="#" class="active-icon"><i class="fa-solid fa-pen"></i></a>
            </div>
            <div class="navbar-icon mx-2">
                <a href="profile.php"><i class="fa-solid fa-user"></i></a>
                <div id="current-user" data-id-user="<?php echo $_SESSION['user_id']; ?>"></div>
            </div>
        </nav>
    </div>

    <!-- Post-it -->
    <div class="pretty-bg mt-3">
         <div class="write-post w-100 d-flex justify-content-center align-items-center">
            <form id="post-form" class="w-75 d-flex flex-column justify-content-center align-items-center">
                <div class="title-div mt-5 w-100">
                    <label for="title" id="title-label">Título de la Publicación</label>
                    <div class="input-div small-input w-100 d-flex justify-content-center">
                        <input class="w-100" type="text" placeholder="Aquí va tu título" id="title" name="title" value="<?= !empty($_POST['title'])?$_POST['title']:''?>">
                    </div>
                </div>
                <div class="company-div mt-3 w-100">
                    <label for="company" id="company-label">Nombre de la Empresa</label>
                    <div class="input-div small-input w-100 d-flex justify-content-center">
                        <input class="w-100" type="text" name="company" id="company" placeholder="Escibe el nombre de la empresa" value="<?= !empty($_POST['company'])?$_POST['company']:''?>">
                    </div>
                </div>
                <p id="output"></p>
                <div class="rating-div mt-3 w-100">
                    <div class="rating w-100 d-flex flex-column">
                        <label id="rating-label">¿Qué calificación le das a la empresa?</label>
                        <div class="star-div d-flex flex-row">
                            <input type='hidden' id='grade-post' value="<?= !empty($_POST['grade'])?$_POST['grade']:''?>">
                            <?php
                                if(isset($_POST['grade'])){
                                    $star = $_POST['grade'];
                                    for($i = 0; $i < 5; $i++){
                                        if($i < $star){
                                            if ($star == 1) $cls = "one";
                                            else if ($star == 2) $cls = "two";
                                            else if ($star == 3) $cls = "three";
                                            else if ($star == 4) $cls = "four";
                                            else if ($star == 5) $cls = "five";
                                            echo "<span class='star-rating ".$cls."'>★</span>";
                                        }else{
                                            echo '<span class="star-rating">★</span>';
                                        }
                                    }
                                }else{
                                    for($i = 0; $i < 5; $i++){
                                        echo '<span class="star-rating">★</span>';
                                    }    
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="description-div mt-3 w-100">
                    <label for="description" id="description-div">Descripción</label>
                    <div class="input-div big-input w-100 d-flex justify-content-center">
                        <input class="w-100" type="text" name="description" id="description" placeholder="Describe tu experiencia" value="<?= !empty($_POST['description'])?$_POST['description']:''?>">
                    </div>
                </div>

                <div class="btn-div w-25 mt-4 mb-5">
                    <input type="hidden" id="postId" name="id" value="<?= !empty($_POST['id'])?$_POST['id']:''?>">
                    <button type="submit" class="btn post-btn w-100 btn-outline-success" id="add-edit"></button>
                </div>
            </form>
        </div>   
    </div>
    

    <!-- Footer -->
    <div class="footer-bit">
        <footer>

        </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
    <!-- Lógica del Frontend -->
    <script src="../app.js"></script>
</body>
</html>