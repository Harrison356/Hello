<?php
$servername = "localhost";
$username = "root"; // substitua pelo seu nome de usuário do MySQL
$password = ""; // substitua pela sua senha do MySQL
$dbname = "user_auth";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, name, password FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Verificar senha
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            echo "Login bem-sucedido! Bem-vindo " . $row['name'];
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Nenhum usuário encontrado com esse e-mail.";
    }
}

$conn->close();
?>
