<?php
error_reporting(E_ALL); // Ativa a exibição de todos os erros
ini_set('display_errors', 1); // Configura para exibir os erros

if (isset($_POST['submit'])) {
    include_once('config.php');

    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];
    $editora = $_POST['editora'];

    $query = "INSERT INTO cadastro (titulo, autor, ano, editora) VALUES ('$titulo', '$autor', '$ano', '$editora')";

    if (mysqli_query($conexao, $query)) {
        header('Location: cadastro_livro.php?success=1'); // Redireciona para a mesma página após o cadastro com parâmetro de sucesso
        exit(); // Encerra o script para garantir que o redirecionamento ocorra
    } else {
        echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro | Livro</title>
    <style>
        /* Estilo do corpo do documento */
        body {
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        /* Estilo do cabeçalho principal */
        h1 {
            background: rgba(0, 0, 0, 0.3);
            padding: 10px;
            border-radius: 15px 15px 0 0;
            margin: 0;
        }
        /* Estilo da barra de navegação */
        nav {
            display: flex;
            justify-content: center;
            gap: 10px;
            padding: 20px;
        }
        /* Estilo dos botões de navegação */
        nav button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        /* Efeito hover para os botões de navegação */
        nav button:hover {
            background-color: #0056b3;
        }
        /* Estilo das etiquetas dos formulários */
        label {
            display: block;
            font-size: 18px;
        }
        /* Estilo dos campos de entrada de texto, número e data */
        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin: 5px auto;
            display: block;
        }
        /* Estilo do campo de entrada de texto, número e data quando focado */
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #007bff;
        }
        /* Estilo do placeholder do campo de entrada de texto e número */
        input[type="text"]::placeholder,
        input[type="number"]::placeholder {
            color: #bbb;
        }
        /* Estilo do botão de submissão do formulário */
        button[type="submit"] {
            margin-top: 10px;
            padding: 10px 30px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        /* Efeito hover para o botão de submissão */
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        /* Estilo do botão de logout */
        .logout-button {
            position: fixed;
            top: 10px;
            right: 10px;
        }
        /* Estilo do link de logout */
        .logout-button a {
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
        }
        /* Efeito hover para o link de logout */
        .logout-button a:hover {
            background-color: #c82333;
        }
        /* Estilo da mensagem de sucesso */
        .success-message {
            color: #28a745;
            font-size: 18px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <!-- Cabeçalho principal -->
    <header>
        <h1>Controle de Livros: Gestão Eficiente</h1>
    </header>
    
    <!-- Barra de navegação -->
    <nav>
        <a href="sistema.php"><button><b>Home</b></button></a>
        <a href="cadastro_livro.php"><button><b>Cadastro</b></button></a>
        <a href="busca_livro.php"><button><b>Busca de Livro</b></button></a>
        <a href="relatorio.php"><button><b>Relatório</b></button></a>
        <a href="reserva.php"><button><b>Reserva de Livro</b></button></a>
    </nav>
    
    <!-- Botão de logout -->
    <div class="logout-button">
        <a href="home.php">Sair</a>
    </div>
    
    <!-- Seção de cadastro de livro -->
    <section id="cadastro">
        <h2>Cadastro de Livro</h2>
        <!-- Verifica se houve sucesso no cadastro e exibe mensagem -->
        <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="success-message">Livro cadastrado com sucesso!</div>
        <?php endif; ?>
        <!-- Formulário de cadastro de livro -->
        <form action="cadastro_livro.php" method="POST">
            <label for="titulo"><b>Título:</b></label>
            <input type="text" id="titulo" name="titulo" required>
            
            <label for="autor"><b>Autor:</b></label>
            <input type="text" id="autor" name="autor" required>
            
            <label for="ano"><b>Ano:</b></label>
            <input type="date" name="ano" id="ano" required>
                   
            <label for="editora">Editora:</label>
            <input type="text" id="editora" name="editora" required>
            
            <button type="submit" name="submit"><b>Cadastrar</b></button>
        </form>
    </section>
</body>
</html>
