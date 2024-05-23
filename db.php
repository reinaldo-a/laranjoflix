<?php 
    
$host = "localhost";
$db = "shareflix";
$user = "root";
$pass = "";

try {
    // Conexão com o banco de dados
    $conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);

    // Habilitar erros PDO
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch (PDOException $e) {
    // Exibir mensagem de erro caso a conexão falhe
    echo "Erro de conexão: " . $e->getMessage();
    // Encerrar o script ou realizar outra ação, dependendo do caso
    die();
}
?>
