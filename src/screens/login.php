<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $my_sqli = require __DIR__ . "../../../backend/config/database.php";

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
    <title>Registro</title>
</head>
<body>
    <h1>Inicio de Sesión</h1>

    <?php if ($is_invalid): ?>
        <em>Inicio de sesión inválido</em>
    <?php endif; ?>
    
    <div class="registro">
        <form method="POST">
            <div class="email-div">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="correo@dominio.com"
                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            </div>
            <div class="password-div">
                <input type="password" name="password" id="password" placeholder="Crea una contraseña">
            </div>

            <button>Inicia sesión</button>
        </form>
        <div class="login">
         <p>¿No tienes una cuenta? <a href="signup.html">Regístrate</a></p>
        </div>
    </div>
</body>
</html>