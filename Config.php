<?php

    // Definição dos dados de conexão com o banco de dados
    $dbHost = 'Localhost'; // Endereço do servidor do banco de dados
    $dbUsername = 'root'; // Nome de usuário do banco de dados
    $dbPassword = ''; // Senha do banco de dados
    $dbName = 'formulario-biblioteca'; // Nome do banco de dados

    // Estabelece a conexão com o banco de dados usando os dados fornecidos
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // Verifica se houve falha na conexão (opcional)
    //if($conexao->connect_errno){
    //    echo "Falha ao se conectar";
    //}
    //else{
    //    echo "conectado ao bando de dadados com sucesso";
    //}

    // Obtém os valores dos filtros enviados via GET

?>
