<?php

require __DIR__ . "../../backend/config/login_db.php";

if (empty($_POST["username"])) {
    die("El nombre de usuario es obligatorio");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Se necesita un email válido");
}

if (strlen($_POST["password"]) < 8) {
    die("La contraseña debe ser de al menos 8 caracteres");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("La contraseña debe incluir al menos una letra");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("La contraseña debe incluir al menos un número");
}

if ($_POST["password"] !== $_POST["password-confirm"]) {
    die("Las contraseñas deben coincidir");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql  = "INSERT INTO user (username, email, password)
         VALUES (?, ?, ?)";

$stmt = $my_sqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL Error: " . $my_sqli->error);
}

$stmt->bind_param("sss", $_POST["username"], $_POST["email"],  $password_hash);


if ($stmt->execute()) {
    header("Location: signup-sucess.html");
    exit;
} else {
    if ($my_sqli->errno === 1602) {
        die("Ya hay una cuenta vinculada a este email");
    } else {
        die($my_sqli->error . " " . $my_sqli->errno);
    }
    
}

