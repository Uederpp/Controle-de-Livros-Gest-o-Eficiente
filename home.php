<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA | BIBLIOTECÁRIO </title>
    <style>
        /* Estilos para o corpo da página */
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            text-align: center; /* Centraliza o texto */
            color: white;
        }
        /* Estilos para o contêiner */
        .box{
            position: absolute; /* Posição absoluta em relação ao viewport */
            top: 50%; /* Posicionamento vertical no centro */
            left: 50%; /* Posicionamento horizontal no centro */
            transform: translate(-50%,-50%); /* Centraliza o contêiner */
            background-color: rgba(0, 0, 0, 0.6); /* Fundo semi-transparente */
            padding: 30px; /* Espaçamento interno */
            border-radius: 10px; /* Borda arredondada */
        }
        /* Estilos para o título principal */
        h1 {
            background: rgba(0, 0, 0, 0.3); /* Fundo semi-transparente */
            padding: 10px; /* Espaçamento interno */
            border-radius: 15px 15px 0 0; /* Borda arredondada */
            margin: 0; /* Remove margem padrão */
        }
        /* Estilos para o título secundário */
        h2 {
            background: rgba(0, 0, 0, 0.3); /* Fundo semi-transparente */
            padding: 10px; /* Espaçamento interno */
            border-radius: 15px 15px 0 0; /* Borda arredondada */
            margin: 0; /* Remove margem padrão */
        }
        /* Estilos para os links */
        a{
            text-decoration: none; /* Remove sublinhado */
            color: white; /* Cor do texto */
            border: 3px solid dodgerblue; /* Borda sólida com cor */
            border-radius: 10px; /* Borda arredondada */
            padding: 10px; /* Espaçamento interno */
        }
        /* Efeito hover para os links */
        a:hover{
            background-color: dodgerblue; /* Altera a cor de fundo no hover */
        }
    </style>
</head>
<body>
    <!-- Título principal -->
    <h1>Controle de Livros: Gestão Eficiente</h1> 
    <!-- Contêiner com links -->
    <div class="box">
        <a href="login.php">Login</a> <!-- Link para a página de login -->
        <a href="formulario.php">Cadastre-se</a> <!-- Link para a página de cadastro -->
    </div>
</body>
</html>
