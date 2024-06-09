<?php 


/* information about the database */
$host = "localhost";
$db = "shareflix";
$user = "root";
$pass = "";

try {
    // Connection to the database
    $conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);

    // Enable PDO errors
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
} catch (PDOException $e) {
    // Display error message if connection fails
    echo "Erro de conexão: " . $e->getMessage();
    // End the script and perform another action, depending on the caseE
    die();
}
?>
