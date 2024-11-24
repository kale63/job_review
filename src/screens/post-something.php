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
            </div>
        </nav>
    </div>

    <!-- Post-it -->
    <div class="pretty-bg mt-3">
         <div class="write-post w-100 d-flex justify-content-center align-items-center">
            <form action="" method="POST" class="w-75 d-flex flex-column justify-content-center align-items-center">
                <div class="title-div mt-5 w-100">
                    <label for="title" id="title-label">Título de la Publicación</label>
                    <div class="input-div small-input w-100 d-flex justify-content-center">
                        <input class="w-100" type="text" placeholder="Aquí va tu título" id="title" name="title">
                    </div>
                </div>
                <div class="company-div mt-3 w-100">
                    <label for="company" id="company-label">Nombre de la Empresa</label>
                    <div class="input-div small-input w-100 d-flex justify-content-center">
                        <input class="w-100" type="text" name="company" id="company" placeholder="Escibe el nombre de la empresa">
                    </div>
                </div>
                <div class="rating-div mt-3 w-100">
                    <div class="rating w-100 d-flex flex-column">
                        <label id="rating-label">¿Qué calificación le das a la empresa?</label>
                        <div class="star-div d-flex flex-row">
                            <span onclick="gfg(1)" class="star">★</span>
                            <span onclick="gfg(2)" class="star">★</span>
                            <span onclick="gfg(3)" class="star">★</span>
                            <span onclick="gfg(4)" class="star">★</span>
                            <span onclick="gfg(5)" class="star">★</span>
                        </div>
                    </div>
                </div>
                <div class="description-div mt-3 w-100">
                    <label for="description" id="description-div">Descripción</label>
                    <div class="input-div big-input w-100 d-flex justify-content-center">
                        <input class="w-100" type="text" name="description" id="description" placeholder="Describe tu experiencia">
                    </div>
                </div>

                <div class="btn-div w-25 mt-4">
                    <button type="submit" class="btn post-btn w-100">Publicar</button>
                </div>
            </form>
        </div>   
    </div>
    

    <!-- Footer -->
    <div class="footer-bit">
        <footer>

        </footer>
    </div>
</body>
</html>