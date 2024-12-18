<?php
session_start();

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
                <a href="post-something.php"><i class="fa-solid fa-pen" id="publicar"></i></a>
            </div>
            <div class="input-group mx-2" id="search-bar">
                <input id="search-icon" type="text" class="form-control" placeholder="Búsqueda" aria-describedby="button-addon">
                <button class="btn btn-outline-secondary" type="button" id="button-addon">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
            <div class="mx-2">
                <i class="navbar-icon fa-solid fa-filter" id="filter-icon"></i>
                <div id="checkboxList" style="display: none;">
                    <ul>
                        <li><input type="checkbox" class="checkbox" checked>★</li>
                        <li><input type="checkbox" class="checkbox" checked>★★</li>
                        <li><input type="checkbox" class="checkbox" checked>★★★</li>
                        <li><input type="checkbox" class="checkbox" checked>★★★★</li>
                        <li><input type="checkbox" class="checkbox" checked>★★★★★</li>
                    </ul>
                </div>
            </div>
            <div class="navbar-icon mx-2">
                <a href="profile.php"><i class="fa-solid fa-user"></i></a>
                <div id="current-user" data-id-user="<?php echo $_SESSION['user_id']; ?>"></div>
            </div>
            <div class="navbar-icon mx-2">
                <i class="show-sidebar fa-solid fa-chart-bar"></i>
            </div>
            <!--<div class="navbar-icon mx-2">
                <a href="index.php"><i class="fa-solid fa-circle-info"></i></a>
            </div>-->
        </nav>
    </div>  
    
    <div id="sidebar" class="p-4">
        <div>
            <div class="navbar-icon mx-2 pb-4"><i class="show-sidebar fa-solid fa-chart-bar"></i></div>
            <h3>Cantidad de posts por calificación</h3>
            <div id="grafica-stars" class="pt-4" style="width: 600px; height: 400px;"></div>
        </div>
    </div>

    <div id="content" class="main-content pretty-bg mb-5">
        <div class="welcome-tab w-100 d-flex flex-column">
            <!-- Info -->
            <div class="rating mt-5 w-100 d-flex flex-column justify-content-center align-items-center">
                <h6>La calificación actual de las empresas en México es de: </h6>
                <h3 id="rating"></h3>
                <div id="rating-average" class="star-div d-flex flex-row">
                    <!--- Estrellas del promedio-->
                </div>
            </div>
        </div>
        
        <div class="post-tab">
            <!-- Posts -->
            <div class="posts">

            </div>
            <div id="content-post"class="p-4 mt-5 d-flex flex-row flex-wrap w-100 justify-content-around">
                <!-- Posts go here -->
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"></script>
      <script src="http://code.highcharts.com/highcharts.js"></script>
      <script src="http://code.highcharts.com/modules/exporting.js"></script>
    <!-- Lógica del Frontend -->
    <script src="../app.js"></script>
    
    <!--<script>
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

    </script>-->
</body>
</html>