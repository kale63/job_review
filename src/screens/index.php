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
    <link rel="stylesheet" href="../styles/style.css"></body>
    <title>Job Review</title>
</head>
<body>
    <!-- Navbar -->
    <div class="navbar navbar-expand-lg justify-content-center w-100">
        <nav class="navbar-nav d-flex flex-row align-items-center">
            <div class="navbar-icon mx-2">
                <a href="homepage.php"><i class="fa-solid fa-house"></i></a>
            </div>
            <div class="navbar-icon mx-2">
                <a href="post-something.php" class=""><i class="fa-solid fa-pen"></i></a>
            </div>
            <div class="navbar-icon mx-2">
                <a href="profile.php"><i class="fa-solid fa-user"></i></a>
                <div id="current-user" data-id-user="<?php echo $_SESSION['user_id']; ?>"></div>
            </div>
            <div class="navbar-icon mx-2">
                <a href="#" class="active-icon"><i class="fa-solid fa-circle-info"></i></a>
            </div>
        </nav>
    </div>

    <div class="pretty-bg mt-3">
    <div class="welcome-tab w-100 d-flex flex-column">
            <!-- Info -->
            <div class="rating mt-5 w-100 d-flex flex-column justify-content-center align-items-center">
                <h6>Mira los posts de la comunidad para ver qué opinan del trabajo en México</h6>
                <button class="btn btn-outline-secondary mt-3 home-btn">Ver posts</button>
            </div>  
            <div class="info-tab mt-5">
                <div class="container px-4 py-2 mt-5" id="featured-3">
                    <h3 class="pb-2 border-bottom signup-title d-flex justify-content-center">Aprende sobre el objetivo 8 de los ODS</h3>
                    <div class="row g-4 py-3 row-cols-1 row-cols-lg-3">
                    <div class="feature col">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient fs-2 mb-3">
                            <i class="fa-solid fa-poo"></i>
                        </div>
                        <h3 class="fs-2 text-body-emphasis">¿Qué son los Objetivos de Desarrollo Sostenible?</h3>
                        <p>Uh huh, popo.</p>
                        <a href="https://www.un.org/sustainabledevelopment/es/objetivos-de-desarrollo-sostenible/" target="_blank" class="icon-link">
                        No hay popo aqui!
                        <i class="fa-solid fa-link"></i>
                        </a>
                    </div>
                    <div class="feature col">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient fs-2 mb-3">
                            <i class="fa-solid fa-poo-storm"></i>
                        </div>
                        <h3 class="fs-2 text-body-emphasis">Objetivo 8: Trabajo Decente y Crecimiento Económico</h3>
                        <p>Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and probably just keep going until we run out of words.</p>
                        <a href="https://www.un.org/sustainabledevelopment/es/economic-growth/" target="_blank" class="icon-link">
                        Call to action
                        <i class="fa-solid fa-link"></i>
                        </a>
                    </div>
                    <div class="feature col">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient fs-2 mb-3">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h3 class="fs-2 text-body-emphasis">Organización Internacional del Trabajo</h3>
                        <p>Ve lo que la comunidad piensa sobre las empresas.</p>
                        <a href="https://www.ilo.org/" target="_blank" class="icon-link">
                        Call to action
                        <i class="fa-solid fa-link"></i>
                        </a>
                    </div>
                    </div>
                </div>
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