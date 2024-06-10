<?php
error_reporting(E_ALL); // Ativa a exibição de todos os erros
ini_set('display_errors', 1); // Configura para exibir os erros

include_once('config.php'); // Inclui a configuração do banco de dados

$searchResults = [];
$successMessage = '';
$errorMessage = '';

// Processa a exclusão de um livro
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // Excluir reservas associadas ao livro
    $deleteReservasQuery = "DELETE FROM reservas WHERE livro_id = $delete_id";
    if (!mysqli_query($conexao, $deleteReservasQuery)) {
        $errorMessage = "Erro ao excluir as reservas associadas: " . mysqli_error($conexao);
    } else {
        // Excluir o livro
        $deleteQuery = "DELETE FROM cadastro WHERE id = $delete_id";
        if (mysqli_query($conexao, $deleteQuery)) {
            $successMessage = "Livro excluído com sucesso!";
            // Redireciona para a mesma página com a query string de busca para manter a listagem
            $buscarTitulo = isset($_POST['buscarTitulo']) ? $_POST['buscarTitulo'] : '';
            header("Location: busca_livro.php?buscarTitulo=$buscarTitulo&successMessage=" . urlencode($successMessage));
            exit();
        } else {
            $errorMessage = "Erro ao excluir o livro: " . mysqli_error($conexao);
        }
    }
}

// Se houver uma mensagem de sucesso na query string, exibi-la
if (isset($_GET['successMessage'])) {
    $successMessage = urldecode($_GET['successMessage']);
}

if (isset($_GET['buscarTitulo'])) {
    $buscarTitulo = $_GET['buscarTitulo'];
    
    // Verifica se o campo de busca está vazio
    if (empty($buscarTitulo)) {
        // Consulta para buscar todos os livros
        $query = "SELECT * FROM cadastro";
    } else {
        // Consulta para buscar livros pelo título
        $query = "SELECT * FROM cadastro WHERE titulo LIKE '%$buscarTitulo%'";
    }

    $result = mysqli_query($conexao, $query);
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = $row;
        }
        if (empty($searchResults)) {
            $errorMessage = "Nenhum livro encontrado com o título \"$buscarTitulo\".";
        }
    } else {
        echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Metadados do documento -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca | Livro</title>
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
        /* Estilo dos campos de entrada de texto */
        input[type="text"] {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin: 5px auto;
            display: block;
        }
        /* Estilo do campo de entrada de texto quando focado */
        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
        }
        /* Estilo do placeholder do campo de entrada de texto */
        input[type="text"]::placeholder {
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
        /* Estilo da tabela de resultados */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007bff;
        }
        td {
            background-color: #f2f2f2;
            color: black;
        }
        /* Estilo do botão de exclusão */
        .delete-button {
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        /* Efeito hover para o botão de exclusão */
        .delete-button:hover {
            background-color: #c82333;
        }
        /* Estilo da mensagem de sucesso */
        .success-message {
            color: #28a745;
            font-size: 18px;
            margin: 20px 0;
        }
        /* Estilo da mensagem de erro */
        .error-message {
            color: #dc3545;
            font-size: 18px;
            margin: 20px 0;
        }
    </style>
    <script>
        function confirmDelete(id, title) {
            if (confirm('Tem certeza que deseja excluir o livro "' + title + '"?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
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
    
    <!-- Seção de busca de livro -->
    <section id="busca">
        <h2>Busca de Livro</h2>
        <?php if ($successMessage): ?>
            <div class="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <?php if ($errorMessage): ?>
            <div class="error-message"><?php echo $errorMessage; ?></div>
        <?php endif; ?>
        <form action="busca_livro.php" method="GET">
            <label for="buscarTitulo"><b>Título:</b></label>
            <input type="text" id="buscarTitulo" name="buscarTitulo" value="<?php echo isset($buscarTitulo) ? $buscarTitulo : ''; ?>">
            
            <button type="submit"><b>Buscar</b></button>
        </form>
        
        <?php if (!empty($searchResults)): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>Editora</th>
                    <th>Ações</th>
                </tr>
                <?php foreach ($searchResults as $livro): ?>
                    <tr>
                        <td><?php echo $livro['id']; ?></td>
                        <td><?php echo $livro['titulo']; ?></td>
                        <td><?php echo $livro['autor']; ?></td>
                        <td><?php echo $livro['ano']; ?></td>
                        <td><?php echo $livro['editora']; ?></td>
                        <td>
                            <form id="delete-form-<?php echo $livro['id']; ?>" action="busca_livro.php" method="POST" style="display:inline;">
                                <input type="hidden" name="delete_id" value="<?php echo $livro['id']; ?>">
                                <input type="hidden" name="buscarTitulo" value="<?php echo isset($buscarTitulo) ? $buscarTitulo : ''; ?>">
                                <button type="button" class="delete-button" onclick="confirmDelete(<?php echo $livro['id']; ?>, '<?php echo addslashes($livro['titulo']); ?>')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </section>
</body>
</html>
