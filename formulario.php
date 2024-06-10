<?php

    if(isset($_POST['submit'])) // Verifica se o formulário foi enviado
    {
        include_once('config.php'); // Inclui o arquivo de configuração do banco de dados

        // Obtém os valores dos campos do formulário
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $sexo = $_POST['genero'];
        $data_Nascimento = $_POST['data_Nascimento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $endereco = $_POST['endereco'];

        // Insere os dados no banco de dados
        $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,email,senha,telefone,sexo,data_Nascimento,cidade,estado,endereco) 
        VALUES ('$nome','$email','$senha','$telefone','$sexo','$data_Nascimento','$cidade','$estado','$endereco')");

        header('Location: login.php'); // Redireciona para a página de login após o cadastro
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário | Biblioteca</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif; /* Define a fonte padrão para o corpo do documento */
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71)); /* Define um fundo com gradiente */
        }
        .box{
            color: white; /* Define a cor do texto dentro da caixa */
            position: absolute; /* Define a posição absoluta para a caixa */
            top: 50%; /* Define a posição vertical da caixa como 50% do topo da tela */
            left: 50%; /* Define a posição horizontal da caixa como 50% da esquerda da tela */
            transform: translate(-50%,-50%); /* Move a caixa para o centro da tela */
            background-color: rgba(0, 0, 0, 0.6); /* Define a cor de fundo da caixa com opacidade */
            padding: 15px; /* Adiciona um preenchimento interno à caixa */
            border-radius: 15px; /* Adiciona bordas arredondadas à caixa */
            width: 20%; /* Define a largura da caixa como 20% da largura da tela */
        }
        fieldset{
            border: 3px solid dodgerblue; /* Define uma borda sólida para o campo */
        }
        legend{
            border: 1px solid dodgerblue; /* Define uma borda sólida para a legenda */
            padding: 10px; /* Adiciona um preenchimento interno à legenda */
            text-align: center; /* Alinha o texto da legenda ao centro */
            background-color: dodgerblue; /* Define a cor de fundo da legenda */
            border-radius: 8px; /* Adiciona bordas arredondadas à legenda */
        }
        .inputBox{
            position: relative; /* Define a posição relativa para a caixa de entrada */
        }
        .inputUser{
            background: none; /* Remove o fundo da caixa de entrada */
            border: none; /* Remove a borda da caixa de entrada */
            border-bottom: 1px solid white; /* Adiciona uma borda na parte inferior da caixa de entrada */
            outline: none; /* Remove o contorno quando a caixa de entrada está focada */
            color: white; /* Define a cor do texto dentro da caixa de entrada */
            font-size: 15px; /* Define o tamanho da fonte da caixa de entrada */
            width: 100%; /* Define a largura da caixa de entrada como 100% */
            letter-spacing: 2px; /* Define o espaçamento entre as letras na caixa de entrada */
        }
        .labelInput{
            position: absolute; /* Define a posição absoluta para a etiqueta */
            top: 0px; /* Define a posição superior da etiqueta como 0px */
            left: 0px; /* Define a posição esquerda da etiqueta como 0px */
            pointer-events: none; /* Impede que a etiqueta seja clicada */
            transition: .5s; /* Adiciona uma transição suave à etiqueta */
        }
        .inputUser:focus ~ .labelInput, /* Quando a caixa de entrada está focada ou possui um valor válido, move a etiqueta para cima */
        .inputUser:valid ~ .labelInput{
            top: -20px; /* Move a etiqueta para cima */
            font-size: 12px; /* Reduz o tamanho da fonte da etiqueta */
            color: dodgerblue; /* Define a cor da etiqueta */
        }
        #data_nascimento{
            border: none; /* Remove a borda da caixa de entrada */
            padding: 8px; /* Adiciona um preenchimento interno à caixa de entrada */
            border-radius: 10px; /* Adiciona bordas arredondadas à caixa de entrada */
            outline: none; /* Remove o contorno quando a caixa de entrada está focada */
            font-size: 15px; /* Define o tamanho da fonte da caixa de entrada */
        }
        #submit{
            background-image: linear-gradient(to right,rgb(0, 92, 197), rgb(90, 20, 220)); /* Define um fundo com gradiente para o botão de envio */
            width: 100%; /* Define a largura do botão de envio como 100% */
            border: none; /* Remove a borda do botão de envio */
            padding: 15px; /* Adiciona um preenchimento interno ao botão de envio */
            color: white; /* Define a cor do texto dentro do botão de envio */
            font-size: 15px; /* Define o tamanho da fonte do texto dentro do botão de envio */
            cursor: pointer; /* Define o cursor como um ponteiro ao passar sobre o botão de envio */
            border-radius: 10px; /* Adiciona bordas arredondadas ao botão de envio */
        }
        #submit:hover{
            background-image: linear-gradient(to right,rgb(0, 80, 172), rgb(80, 19, 195)); /* Altera o fundo com gradiente quando o mouse passa sobre o botão de envio */
        }
        .btn-voltar { /* Estilo para o botão "Voltar" */
            display: inline-block; /* Define o elemento como um bloco com margem */
            margin: 10px; /* Adiciona uma margem ao redor do botão */
            padding: 10px 20px; /* Adiciona um preenchimento interno ao botão */
            background-color: rgba(0, 0, 0, 0.6); /* Define a cor de fundo do botão com opacidade */
            color: white; /* Define a cor do texto dentro do botão */
            text-decoration: none; /* Remove o sublinhado do texto */
            border-radius: 5px; /* Adiciona bordas arredondadas ao botão */
        }
        .btn-voltar:hover {
            background-color: #0056b3; /* Altera a cor de fundo quando o mouse passa sobre o botão */
        }
    </style>
</head>
    <body>
        <!-- Botão "Voltar" estilizado -->
        <a class="btn-voltar" href="home.php">Voltar</a> 

        <!-- Caixa principal do formulário -->
        <div class="box">
            <form action="formulario.php" method="POST">
                <fieldset>
                    <!-- Título do formulário -->
                    <legend><b>Fórmulário de Clientes</b></legend>
                    <br>
                    <!-- Campo de entrada para o nome -->
                    <div class="inputBox">
                        <input type="text" name="nome" id="nome" class="inputUser" required>
                        <label for="nome" class="labelInput">Nome completo</label>
                    </div>
                    <br>
                    <!-- Campo de entrada para a senha -->
                    <div class="inputBox">
                        <input type="password" name="senha" id="senha" class="inputUser" required>
                        <label for="senha" class="labelInput">Senha</label>
                    </div>
                    <br><br>
                    <!-- Campo de entrada para o email -->
                    <div class="inputBox">
                        <input type="text" name="email" id="email" class="inputUser" required>
                        <label for="email" class="labelInput">Email</label>
                    </div>
                    <br><br>
                    <!-- Campo de entrada para o telefone -->
                    <div class="inputBox">
                        <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                        <label for="telefone" class="labelInput">Telefone</label>
                    </div>
                    <!-- Opções de sexo -->
                    <p>Sexo:</p>
                    <input type="radio" id="feminino" name="genero" value="feminino" required>
                    <label for="feminino">Feminino</label>
                    <br>
                    <input type="radio" id="masculino" name="genero" value="masculino" required>
                    <label for="masculino">Masculino</label>
                    <br>
                    <input type="radio" id="outro" name="genero" value="outro" required>
                    <label for="outro">Outro</label>
                    <br><br>
                    <!-- Campo de entrada para a data de nascimento -->
                    <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                    <input type="date" name="data_nascimento" id="data_nascimento" required>
                    <br><br><br>
                    <!-- Campo de entrada para a cidade -->
                    <div class="inputBox">
                        <input type="text" name="cidade" id="cidade" class="inputUser" required>
                        <label for="cidade" class="labelInput">Cidade</label>
                    </div>
                    <br><br>
                    <!-- Campo de entrada para o estado -->
                    <div class="inputBox">
                        <input type="text" name="estado" id="estado" class="inputUser" required>
                        <label for="estado" class="labelInput">Estado</label>
                    </div>
                    <br><br>
                    <!-- Campo de entrada para o endereço -->
                    <div class="inputBox">
                        <input type="text" name="endereco" id="endereco" class="inputUser" required>
                        <label for="endereco" class="labelInput">Endereço</label>
                    </div>
                    <br><br>
                    <!-- Botão de envio do formulário -->
                    <input type="submit" name="submit" id="submit">
                </fieldset>
            </form>
        </div>
    </body>
</html>