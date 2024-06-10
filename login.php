<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <style>
        /* Estilos CSS para o corpo da página */
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        /* Estilos CSS para o contêiner do formulário de login */
        div{
            background-color: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 80px;
            border-radius: 15px;
            color: #fff;
        }
        /* Estilos CSS para os campos de entrada de texto */
        input{
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }
        /* Estilos CSS para o botão de envio */
        .inputSubmit{
            background-color: dodgerblue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
            font-size: 15px;
        }
        /* Efeito hover para o botão de envio */
        .inputSubmit:hover{
            background-color: deepskyblue;
            cursor: pointer;
        }

        /* Estilos CSS para o botão "Voltar" */
        .btn-voltar {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        /* Efeito hover para o botão "Voltar" */
        .btn-voltar:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Botão "Voltar" estilizado -->
    <a class="btn-voltar" href="home.php">Voltar</a> 

    <!-- Contêiner do formulário de login -->
    <div>
        <h1>Login</h1>
        <!-- Formulário de login -->
        <form action="testLogin.php" method="POST">
            <!-- Campo de entrada para o email -->
            <input type="text" name="email" placeholder="Email">
            <br><br>
            <!-- Campo de entrada para a senha -->
            <input type="password" name="senha" placeholder="Senha">
            <br><br>
            <!-- Botão de envio -->
            <input class="inputSubmit" type="submit" name="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
