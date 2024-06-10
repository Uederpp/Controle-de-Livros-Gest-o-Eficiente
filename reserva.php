<?php
include_once('config.php'); // Inclui o arquivo de configuração do banco de dados

// Função para buscar livros disponíveis
function getLivrosDisponiveis($conexao) {
    $query = "SELECT * FROM cadastro WHERE id NOT IN (SELECT livro_id FROM reservas)";
    $result = mysqli_query($conexao, $query);
    $livros = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $livros[] = $row; // Adiciona cada livro disponível à lista de livros
    }
    return $livros;
}

// Função para listar reservas
function listarReservas($conexao) {
    $query = "SELECT r.id, c.titulo, r.aluno, r.data_reserva 
              FROM reservas r 
              JOIN cadastro c ON r.livro_id = c.id";
    $result = mysqli_query($conexao, $query);
    return $result; // Retorna o resultado da consulta de reservas
}

// Processar reserva de livro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livro_id = $_POST['livro_id'];
    $aluno = $_POST['reservaNome'];

    // Verificar se o livro já está reservado
    $checkQuery = "SELECT * FROM reservas WHERE livro_id = '$livro_id'";
    $checkResult = mysqli_query($conexao, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $reservaMessage = 'Este livro já está reservado.';
    } else {
        // Inserir reserva no banco de dados
        $insertQuery = "INSERT INTO reservas (livro_id, aluno) VALUES ('$livro_id', '$aluno')";
        if (mysqli_query($conexao, $insertQuery)) {
            $reservaMessage = 'Livro reservado com sucesso!';
        } else {
            $reservaMessage = 'Erro ao reservar o livro.';
        }
    }
}

// Processar cancelamento de reserva
if (isset($_GET['cancelarReserva'])) {
    $id = $_GET['cancelarReserva'];
    $deleteQuery = "DELETE FROM reservas WHERE id = $id";
    if (mysqli_query($conexao, $deleteQuery)) {
        $cancelarMessage = 'Reserva cancelada com sucesso!';
    } else {
        $cancelarMessage = 'Erro ao cancelar a reserva.';
    }
}

// Obtém os livros disponíveis e as reservas
$livrosDisponiveis = getLivrosDisponiveis($conexao);
$reservas = listarReservas($conexao);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva | Biblioteca</title>
    <style>
        /* Estilização da página com um gradiente de fundo */
        body {
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        /* Estilo do título principal */
        h1 {
            background: rgba(0, 0, 0, 0.3);
            padding: 10px;
            border-radius: 15px 15px 0 0;
            margin: 0;
        }

        /* Estilo da navegação */
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

        /* Efeito de hover nos botões de navegação */
        nav button:hover {
            background-color: #0056b3;
        }

        /* Estilo das seções */
        section {
            margin: 2rem;
            padding: 1rem;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        /* Estilo dos rótulos dos formulários */
        label {
            display: block;
            font-size: 18px;
        }

        /* Estilo dos campos de texto */
        input[type="text"],
        select {
            width: 100%;
            max-width: 400px;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin: 5px auto; /* Centraliza os inputs */
            display: block; /* Cada input em uma linha */
        }

        /* Foco nos campos de texto */
        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #007bff;
        }

        /* Estilo dos botões de submissão */
        button[type="submit"] {
            margin-top: 10px; /* Espaçamento acima do botão */
            padding: 10px 30px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        /* Efeito de hover nos botões de submissão */
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

        /* Efeito de hover no link de logout */
        .logout-button a:hover {
            background-color: #c82333;
        }

        /* Estilo da tabela de reservas */
        table {
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table td {
            background-color: rgba(255, 255, 255, 0.1);
        }

        table tr:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }

        .cancelar-btn {
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cancelar-btn:hover {
            background-color: #c82333;
        }
    </style>
    <script>
        // Função para confirmar e cancelar a reserva
        function cancelarReserva(id) {
            if (confirm("Tem certeza que deseja cancelar esta reserva?")) {
                window.location.href = 'reserva.php?cancelarReserva=' + id;
            }
        }
    </script>
</head>
<body>
    <header>
        <!-- Título da página -->
        <h1>Controle de Livros: Gestão Eficiente</h1>
    </header>
    
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

    <!-- Seção de reserva de livro -->
    <section id="reserva">
        <h2>Reserva de Livro</h2>
        <form id="formReserva" method="POST">
            <label for="reservaLivro"><b>Livro Disponível:</b></label>
            <select id="reservaLivro" name="livro_id" required>
                <option value="">Selecione um livro</option>
                <?php foreach ($livrosDisponiveis as $livro): ?>
                    <option value="<?= htmlspecialchars($livro['id']) ?>"><?= htmlspecialchars($livro['titulo']) ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="reservaNome"><b>Nome do Aluno:</b></label>
            <input type="text" id="reservaNome" name="reservaNome" required>
            
            <button type="submit"><b>Reservar</b></button>
        </form>
        <?php if (isset($reservaMessage)): ?>
            <p><?= htmlspecialchars($reservaMessage) ?></p>
        <?php endif; ?>
    </section>

    <!-- Seção de listagem de reservas -->
    <section id="listagemReservas">
        <h2>Reservas</h2>
        <?php if (mysqli_num_rows($reservas) > 0): ?>
            <table border="1" cellspacing="0" cellpadding="10">
                <tr>
                    <th>Título</th>
                    <th>Aluno</th>
                    <th>Data de Reserva</th>
                    <th>Ações</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($reservas)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['titulo']) ?></td>
                        <td><?= htmlspecialchars($row['aluno']) ?></td>
                        <td><?= htmlspecialchars($row['data_reserva']) ?></td>
                        <td><button onclick="cancelarReserva(<?= $row['id'] ?>)">Cancelar</button></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Nenhuma reserva encontrada.</p>
        <?php endif; ?>
        <?php if (isset($cancelarMessage)): ?>
            <p><?= htmlspecialchars($cancelarMessage) ?></p>
        <?php endif; ?>
    </section>
</body>
</html>
