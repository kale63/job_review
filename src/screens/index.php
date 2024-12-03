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
                <button class="btn btn-outline-secondary mt-3 home-btn"><a href="homepage.php" class="no-underline">Ver post  <i class="fa-solid fa-chevron-right"></i></a></button>
            </div>
            <div class="info-tab mt-5">
                <div class="container px-4 py-2 mt-5" id="featured-3">
                    <h3 class="pb-2 border-bottom signup-title d-flex justify-content-center">Aprende sobre el objetivo 8 de los ODS</h3>
                    <div class="row g-4 py-3 row-cols-1 row-cols-lg-3">
                    <div class="feature col">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient fs-2 mb-3">
                            <!--<i class="fa-solid fa-poo"></i>-->
                            <i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <h3 class="fs-2 text-body-emphasis">¿Qué son los Objetivos de Desarrollo Sostenible?</h3>
                        <p>Creados en 2015 por la ONU en su Agenda 2030, los Objetivos de Desarrollo Sostenible (ODS) son diecisiete objetivos que buscan construir un mundo próspero en el que se valoren de igual manera la sostenibilidad del medio ambiente, la inclusión social y el desarrollo económico. Para alcanzarlos, es necesario involucrar a gobiernos, empresas, sociedad civil y personas individuales. ¡Juntos podemos lograr un cambio!</p>
                        <a href="https://www.un.org/sustainabledevelopment/es/objetivos-de-desarrollo-sostenible/" target="_blank" class="icon-link external-link">
                        ¿Quieres saber más de ellos?
                        <i class="fa-solid fa-link"></i>
                        </a>
                    </div>
                    <div class="feature col">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient fs-2 mb-3">
                            <!--<i class="fa-solid fa-poo-storm"></i>-->
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <h3 class="fs-2 text-body-emphasis">Objetivo 8: Trabajo Decente y Crecimiento Económico</h3>
                        <p>El octavo objetivo busca promover el crecimiento económico inclusivo y sostenible; el empleo pleno y productivo; y el trabajo decente para todas y todos. Todo esto a través de doce metas para evaluar su desarrollo. Este objetivo es importante ya que propone crear una reconsideración sobre la naturaleza del crecimiento económico y un nuevo paradigma del mundo laboral desde el punto de vista de la justicia social.</p>
                        <a href="https://www.un.org/sustainabledevelopment/es/economic-growth/" target="_blank" class="icon-link external-link">
                        Aprende más sobre el octavo ODS
                        <i class="fa-solid fa-link"></i>
                        </a>
                    </div>
                    <div class="feature col">
                        <div class="feature-icon d-inline-flex align-items-center justify-content-center bg-gradient fs-2 mb-3">
                            <i class="fa-solid fa-users"></i>
                            <!--<i class="fa-solid fa-spaghetti-monster-flying"></i>-->
                        </div>
                        <h3 class="fs-2 text-body-emphasis">Organización Internacional del Trabajo</h3>
                        <p>La Organización Internacional del Trabajo (OIT) es la única agencia tripartita de la ONU, ya que reúne a gobiernos, empleadores y trabajadores de los 187 Estados Miembros con el fin de formular políticas y elaborar programas promoviendo el trabajo decente de todos, mujeres y hombres. Su lema es "La justicia social es esencial para la paz universal y permanente", por esto es un pilar para alcanzar el octavo ODS.</p>
                        <a href="https://www.ilo.org/es/" target="_blank" class="icon-link external-link">
                        ¡Visita la página oficial de la OIT!
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