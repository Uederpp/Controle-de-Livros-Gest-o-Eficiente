<?php
include_once('config.php'); // Inclui o arquivo de configuração do banco de dados

// Função para buscar livros reservados
function getLivrosReservados($conexao) {
    $query = "SELECT c.id, c.titulo, r.aluno, r.data_reserva 
              FROM cadastro c 
              JOIN reservas r ON c.id = r.livro_id";
    $result = mysqli_query($conexao, $query);
    return $result;
}

// Função para buscar livros disponíveis
function getLivrosDisponiveis($conexao) {
    $query = "SELECT * FROM cadastro WHERE id NOT IN (SELECT livro_id FROM reservas)";
    $result = mysqli_query($conexao, $query);
    return $result;
}

// Variáveis para armazenar os resultados das consultas
$livrosReservados = [];
$livrosDisponiveis = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $livrosReservados = getLivrosReservados($conexao);
    $livrosDisponiveis = getLivrosDisponiveis($conexao);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerar Relatórios - Sistema de Biblioteca</title>
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
        }

        /* Estilo dos rótulos dos formulários */
        label {
            display: block;
            font-size: 18px;
        }

        /* Estilo dos campos de texto */
        input[type="text"],
        input[type="number"] {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            margin: 5px auto; /* Centraliza os inputs */
            display: block; /* Cada input em uma linha */
        }

        /* Foco nos campos de texto */
        input[type="text"]:focus,
        input[type="number"]:focus {
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

        /* Estilo do botão de gerar relatório */
        #gerarRelatorio {
            padding: 10px 30px;
            background: linear-gradient(to right, #33ccff, #007bff);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s, box-shadow 0.3s;
            margin-top: 20px; /* Aumenta o espaço acima do botão */
        }

        /* Efeito de hover no botão de gerar relatório */
        #gerarRelatorio:hover {
            background: linear-gradient(to right, #007bff, #33ccff);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        /* Estilo das tabelas de relatórios */
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
    </style>
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
    
    <!-- Seção de relatórios -->
    <section id="relatorios">
        <h2>Gerar Relatórios</h2>
        <form id="formRelatorio" action="relatorio.php" method="post">
            <button type="submit" id="gerarRelatorio"><b>Gerar Relatório</b></button>
        </form>
        
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <!-- Tabela de livros reservados -->
            <h3>Livros Reservados</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Aluno</th>
                    <th>Data de Reserva</th>
                </tr>
                <?php while ($livro = mysqli_fetch_assoc($livrosReservados)): ?>
                    <tr>
                        <td><?= htmlspecialchars($livro['id']) ?></td>
                        <td><?= htmlspecialchars($livro['titulo']) ?></td>
                        <td><?= htmlspecialchars($livro['aluno']) ?></td>
                        <td><?= htmlspecialchars($livro['data_reserva']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>

            <!-- Tabela de livros disponíveis -->
            <h3>Livros Disponíveis para Reserva</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                </tr>
                <?php while ($livro = mysqli_fetch_assoc($livrosDisponiveis)): ?>
                    <tr>
                        <td><?= htmlspecialchars($livro['id']) ?></td>
                        <td><?= htmlspecialchars($livro['titulo']) ?></td>
                        <td><?= htmlspecialchars($livro['autor']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php endif; ?>
    </section>
</body>
</html>
