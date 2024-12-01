<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $my_sqli = require __DIR__ ."../../../backend/db.php";

    $sql = sprintf("SELECT * FROM user WHERE email = '%s'",
                    $my_sqli->real_escape_string($_POST["email"]));
    
    $result = $my_sqli->query($sql);

    $user = $result->fetch_assoc();
    
    if ($user) {
        if(password_verify($_POST["password"], $user["password"])) {
            session_start();
            $_SESSION["user_id"] = $user["id"];

            header("Location: index.php");
            exit;
        }
    }

    $is_invalid = true;
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
    <title>Inicio de Sesión</title>
</head>
<body class="white-body">
    <div class="signup-page w-100 d-flex flex-row align-content-center justify-content-around">
        <div class="welcome-back w-50 d-flex justify-content-center">
            <img src="https://i.pinimg.com/736x/2a/97/23/2a9723d9809b015cb29c8479ce31ce23.jpg" class="d-flex justify-content-center">
        </div>

        <div class="signup w-50 mt-5">
            <h1 class="signup-title">Inicio de Sesión</h1>

            <?php if ($is_invalid): ?>
                <em>Inicio de sesión inválido</em>
            <?php endif; ?>
    
            <div class="registro mt-5">
                <form method="POST">
                    <div class="email-div mt-3 w-100">
                        <label for="email" id="email-label">E-mail</label>
                        <div class="input-div smaller-input w-80 d-flex">
                            <input type="email" class="w-100" name="email" id="email" placeholder="correo@dominio.com"
                                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                        </div>
                    </div>
                    <div class="password-div mt-3 w-100">
                        <label for="password" id="pw-label">Contraseña</label>
                        <div class="input-div smaller-input w-80 d-flex">
                            <input type="password" class="w-100" name="password" id="password" placeholder="Ingresa tu Contraseña">
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        <button class="mt-4 btn btn-outline-success post-btn">Iniciar Sesión</button>
                    </div>
                </form>
                <div class="login-a mt-4 d-flex justify-content-center">
                    <p>¿No tienes una cuenta? <a href="signup.html">Regístrate</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>