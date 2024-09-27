<?php
include('../PHP/conectar.php');
session_start();
if (isset($_POST['login'])) {
    $Email_usuario = $_POST['Email_usuario'];
    $ContrasenaUsuario = $_POST['ContrasenaUsuario'];
    $query = $connection->prepare("SELECT * FROM usuario WHERE Email_usuario=:Email_usuario");
    $query->bindParam("Email_usuario", $Email_usuario, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo '<p class="error">Email_usuario ContrasenaUsuario combination is wrong!</p>';
    } else {
        if (ContrasenaUsuario_verify($ContrasenaUsuario, $result['ContrasenaUsuario'])) {
            $_SESSION['id_usuario'] = $result['ID'];
            echo '<p class="success">Congratulations, you are logged in!</p>';
        } else {
            echo '<p class="error">Email_usuario ContrasenaUsuario combination is wrong!</p>';
        }
    }
}
?>