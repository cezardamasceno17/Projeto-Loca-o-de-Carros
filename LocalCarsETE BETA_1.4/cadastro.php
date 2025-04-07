<?php
// Configurações de conexão com o banco de dados
$host = "seu_host";
$dbname = "seu_banco_de_dados";
$user = "seu_usuario";
$password = "sua_senha";

// Conexão com o PostgreSQL
try {
    $conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Obtendo os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$datanascimento = $_POST['datanascimento'];
$telefone = $_POST['telefone'];
$estadocivil = $_POST['estadocivil'];

// Inserindo os dados no banco de dados
$sql = "INSERT INTO locacao_veiculos (nome, email, datanascimento, telefone, estadocivil) VALUES (:nome, :email, :datanascimento, :telefone, :estadocivil)";
$stmt = $conn->prepare($sql);

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':datanascimento', $datanascimento);
$stmt->bindParam(':telefone', $telefone);
$stmt->bindParam(':estadocivil', $estadocivil);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao realizar cadastro.";
}
?>