<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema | Biblioteca - Home</title>
    <style>
        /* Estilização da página com um gradiente de fundo */
        body {
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71)); /* Fundo com gradiente */
            color: white; /* Cor do texto */
            font-family: Arial, sans-serif; /* Fonte do texto */
            margin: 0; /* Margem da página */
            padding: 0; /* Espaçamento interno da página */
        }

        /* Estilo do título principal */
        header h1 {
            background: rgba(0, 0, 0, 0.5); /* Fundo semitransparente */
            padding: 10px 20px; /* Espaçamento interno */
            border-radius: 10px; /* Bordas arredondadas */
            margin: 0; /* Margem */
            text-align: center; /* Alinhamento centralizado do texto */
        }

        /* Estilo da navegação */
        nav {
            display: flex; /* Disposição em linha */
            justify-content: center; /* Centralização dos itens */
            gap: 10px; /* Espaçamento entre itens */
            padding: 20px; /* Espaçamento interno */
        }

        /* Estilo dos botões de navegação */
        nav button {
            padding: 10px 20px; /* Espaçamento interno */
            background-color: #007bff; /* Cor de fundo */
            color: white; /* Cor do texto */
            border: none; /* Sem borda */
            border-radius: 5px; /* Bordas arredondadas */
            font-size: 16px; /* Tamanho da fonte */
            cursor: pointer; /* Cursor de ponteiro */
            transition: background-color 0.3s; /* Transição suave da cor de fundo */
        }

        /* Efeito de hover nos botões de navegação */
        nav button:hover {
            background-color: #0056b3; /* Cor de fundo ao passar o mouse */
        }

        /* Estilo do conteúdo principal */
        main {
            padding: 20px; /* Espaçamento interno */
            text-align: center; /* Alinhamento centralizado do texto */
        }

        /* Estilo do botão de logout */
        .logout-button {
            position: fixed; /* Posição fixa */
            top: 10px; /* Distância do topo */
            right: 10px; /* Distância da direita */
        }

        /* Estilo do link de logout */
        .logout-button a {
            padding: 10px 20px; /* Espaçamento interno */
            background-color: #dc3545; /* Cor de fundo */
            color: white; /* Cor do texto */
            border: none; /* Sem borda */
            border-radius: 5px; /* Bordas arredondadas */
            font-size: 16px; /* Tamanho da fonte */
            text-decoration: none; /* Sem sublinhado */
            cursor: pointer; /* Cursor de ponteiro */
        }

        /* Efeito de hover no link de logout */
        .logout-button a:hover {
            background-color: #c82333; /* Cor de fundo ao passar o mouse */
        }

        /* Estilo da imagem de largura total */
        .full-width-image {
            width: 100%; /* Largura total */
            height: auto; /* Altura automática */
            display: block; /* Display de bloco */
            margin-top: 20px; /* Margem superior */
        }
    </style>
</head>
<body>
    <header>
        <!-- Título da página -->
        <h1>Controle de Livros: Gestão Eficiente</h1>
    </header>
    
    <nav>
        <!-- Links de navegação com botões -->
        <a href="sistema.php"><button><b>Home</b></button></a>
        <a href="cadastro_livro.php"><button><b>Cadastro</b></button></a>
        <a href="busca_livro.php"><button><b>Busca de Livro</b></button></a>
        <a href="relatorio.php"><button><b>Relatório</b></button></a>
        <a href="reserva.php"><button><b>Reserva de Livro</b></button></a>
    </nav>

    <!-- Botão de logout -->
    <div class="logout-button">
        <!-- Link para logout -->
        <a href="home.php">Sair</a>
    </div>
    
    <!-- Conteúdo principal -->
    <main>
        <!-- Texto de boas-vindas -->
        <h2>Bem-vindo ao Sistema de Biblioteca</h2>
        <p>Aqui você pode cadastrar livros, buscar livros, gerar relatórios e fazer reservas de livros.</p>
    </main>

    <!-- Imagem do conteúdo principal -->
    <img src="img\imagem biblioteca.jpg" alt="Biblioteca" class="full-width-image">
</body>
</html>
