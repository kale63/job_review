<?php
session_start();

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
    <link rel="stylesheet" href="../styles/style.css">
    <title>Home</title>
</head>
<body>
    <!--<?php if (isset($_SESSION["user_id"])) : ?>
        <p>Iniciaste sesión!</p>
    <?php else: ?>
        <p><a href="login.php">Inicia sesión</a> o <a href="signup.html">regístrate</a> para ver el contenido.</p>
    <?php endif; ?>-->
    
    <!-- Navbar -->
    <div class="navbar-expand-lg justify-content-center w-100">
        <nav class="navbar navbar-nav d-flex flex-row align-items-center">
            <div class="navbar-icon mx-2">
                <a href="#" class="active-icon"><i class="fa-solid fa-house"></i></a>
            </div>
            <div class="navbar-icon mx-2">
                <a href="post-something.php"><i class="fa-solid fa-pen"></i></a>
            </div>
            <div class="input-group mx-2" id="search-bar">
                <input type="text" class="form-control" placeholder="Búsqueda" aria-describedby="button-addon">
                <button class="btn btn-primary" type="button" id="button-addon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="navbar-icon mx-2">
                <i class="fa-solid fa-filter"></i>
            </div>
            <div class="navbar-icon mx-2">
                <a href="profile.php"><i class="fa-solid fa-user"></i></a>
            </div>
        </nav>
    </div>
    
    <div class="pretty-bg mb-5">
        <div class="welcome-tab w-100 d-flex flex-column">
            <!-- Info -->
            <div class="rating mt-5 w-100 d-flex flex-column justify-content-center align-items-center">
                <h6>La calificación actual de las empresas en México es de: </h6>
                <h3 id="rating">placeholder/5</h3>
                <div class="star-div d-flex flex-row">
                    <span onclick="gfg(1)" class="star">★</span>
                    <span onclick="gfg(2)" class="star">★</span>
                    <span onclick="gfg(3)" class="star">★</span>
                    <span onclick="gfg(4)" class="star">★</span>
                    <span onclick="gfg(5)" class="star">★</span>
                </div>
            </div>
        </div>
        
        <div class="post-tab">
            <!-- Posts -->
            <div class="posts">

            </div>
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
                            <div id="bookmark-empty">
                                <i class="fa-regular fa-bookmark"></i>
                            </div>
                            <div class="d-none" id="bookmark-checked">
                                <i class="fa-solid fa-bookmark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--<div class="pagination">
                <div>
                    <ul class="pagination pagination-sm">
                        <li class="page-item disabled">
                        <a class="page-link" href="#">&laquo;</a>
                        </li>
                        <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="#">4</a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="#">5</a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="#">&raquo;</a>
                        </li>
                    </ul>
                </div>
            </div>-->

            <div class="footer-bit">
                <footer>

                </footer>
            </div>
            
        </div>

    </div>
    
    <script>
        //active search bar
        document.getElementById('search-icon').addEventListener('click', function () {
            document.getElementById('search-bar').classList.toggle('d-none');
            document.getElementById('search-icon').classList.toggle('d-none');
        });

        //not bookmarked post
        document.getElementById('bookmark-empty').addEventListener('click', function () {
            document.getElementById('bookmark-checked').classList.toggle('d-none');
            document.getElementById('bookmark-empty').classList.toggle('d-none');
        });

        //bookmarked post
        document.getElementById('bookmark-checked').addEventListener('click', function () {
            document.getElementById('bookmark-empty').classList.toggle('d-none');
            document.getElementById('bookmark-checked').classList.toggle('d-none');
        });

    </script>
</body>
</html>