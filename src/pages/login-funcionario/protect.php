<?php

if(!isset($_SESSION)) {
    session_start();
}

if(!isset($_SESSION['id_funcionario'])) {
    die("Você não pode acessar esta página porque não está logado.<p><a href=\"http://127.0.0.1/ButacaBox/ButacaBox/src/pages/login-funcionario/login.php\">Entrar</a></p>");
}
?>