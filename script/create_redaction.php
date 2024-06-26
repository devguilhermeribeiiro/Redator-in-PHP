<?php
error_reporting(E_ALL); // Exibir todos os erros
ini_set('display_errors', 1); // Ativar exibição de erros

include 'config_db.php'; // Inclui o arquivo de configuração do banco de dados

// Seleciona o banco de dados
mysqli_select_db($db_conn, $db_name);

// Declaração SQL para criar a tabela, se não existir
$sql_create_table = "
CREATE TABLE IF NOT EXISTS Redactions 
(
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    content VARCHAR(3500) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Executa a declaração SQL
if ($db_conn->query($sql_create_table) === TRUE) {
    echo "Table created successfully!<br>";
} else {
    echo "Error creating table: " . $db_conn->error . "<br>";
}

// Verifica se o formulário foi enviado
if (isset($_POST['create'])) {
    echo "Formulário enviado!<br>"; // Mensagem de depuração
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Exibir dados recebidos para depuração
    echo "Título: $title<br>";
    echo "Conteúdo: $content<br>";

    // Verifica se o título ou conteúdo estão vazios
    if (empty($title) || empty($content)) {
        echo "Preencha todo o conteúdo!<br>";
    } else {
        // Declaração SQL para inserir dados na tabela
        $sql_insert_redaction = "INSERT INTO Redactions (title, content) VALUES (?, ?)";

        // Prepara a declaração SQL
        $stmt = $db_conn->prepare($sql_insert_redaction);

        if ($stmt) {
            echo "Preparação da consulta bem-sucedida!<br>"; // Mensagem de depuração
            // Vincula os parâmetros
            $stmt->bind_param("ss", $title, $content);

            // Executa a declaração
            if ($stmt->execute()) {
                echo "Conteúdo inserido com sucesso!<br>";
            } else {
                echo "Erro ao inserir os dados: " . $stmt->error . "<br>";
            }

            // Fecha a declaração
            $stmt->close();
        } else {
            echo "Erro na preparação da consulta: " . $db_conn->error . "<br>";
        }
    }
} else {
    echo "Formulário não foi enviado.<br>"; // Mensagem de depuração
}

// Fecha a conexão com o banco de dados
$db_conn->close();
?>
