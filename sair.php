<?php
    // Inicia a sessão
    session_start();

    // Remove as variáveis de sessão para 'email' e 'senha'
    unset($_SESSION['email']);
    unset($_SESSION['senha']);

    // Redireciona o usuário para a página de login
    header("Location: login.php");
?>
