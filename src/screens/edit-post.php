<?php
include 'db2.php'; 

$title = "";
$company = "";
$rating = 0;
$description = "";

if (isset($_GET['post_id'])) {
    $postId = intval($_GET['post_id']);
    
    $query = $conn->prepare("SELECT title, company, rating, description FROM posts WHERE post_id = ?");
    $query->bind_param("i", $postId);
    $query->execute();
    $result = $query->get_result();
    
    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
        $title = $post['title'];
        $company = $post['company'];
        $rating = $post['rating'];
        $description = $post['description'];
    } else {
        echo "<script>alert('No se encontró la publicación.'); window.location.href='homepage.php';</script>";
        exit;
    }
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
            </div>
        </nav>
    </div>

    <!-- Post-it -->
    <div class="pretty-bg mt-3">
         <div class="write-post w-100 d-flex justify-content-center align-items-center">
            <form action="update-post.php" method="POST" class="w-75 d-flex flex-column justify-content-center align-items-center">
                <input type="hidden" name="post_id" value="<?php echo $postId; ?>">

                <div class="title-div mt-5 w-100">
                    <label for="title" id="title-label">Título de la Publicación</label>
                    <div class="input-div small-input w-100 d-flex justify-content-center">
                        <input class="w-100" type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>">
                    </div>
                </div>

                <div class="company-div mt-3 w-100">
                    <label for="company" id="company-label">Nombre de la Empresa</label>
                    <div class="input-div small-input w-100 d-flex justify-content-center">
                        <input class="w-100" type="text" id="company" name="company" value="<?php echo htmlspecialchars($company); ?>">
                    </div>
                </div>

                <div class="rating-div mt-3 w-100">
                    <div class="rating w-100 d-flex flex-column">
                        <label id="rating-label">¿Qué calificación le das a la empresa?</label>
                        <div class="star-div d-flex flex-row">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <span onclick="gfg(<?php echo $i; ?>)" class="star-rating <?php echo ($i <= $rating) ? 'selected' : ''; ?>">★</span>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <div class="description-div mt-3 w-100">
                    <label for="description" id="description-div">Descripción</label>
                    <div class="input-div big-input w-100 d-flex justify-content-center">
                        <textarea class="w-100" id="description" name="description"><?php echo htmlspecialchars($description); ?></textarea>
                    </div>
                </div>

                <div class="btn-div w-25 mt-4 mb-5">
                    <button type="submit" class="btn post-btn w-100 btn-outline-success">Actualizar</button>
                </div>
            </form>
        </div>   
    </div>
    

    <!-- Footer -->
    <div class="footer-bit">
        <footer>

        </footer>
    </div>

    <script src="../app.js"></script>
</body>
</html>