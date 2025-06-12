<?php
session_start();
require '../conexao/conexao.php';


// SALVAR USER
if (isset($_POST['create_usuario'])) {
    $nome = trim($_POST['nome']);
    $cpfcnpj = trim($_POST['cpfcnpj']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);

    if (empty($nome) || empty($cpfcnpj) || empty($email) || empty($telefone)) {
        $_SESSION['mensagem'] = 'Preencha todos os campos obrigatórios.';
        header('Location: ../index.php');
        exit;
    }

    $nome = mysqli_real_escape_string($conn, $nome);
    $cpfcnpj = mysqli_real_escape_string($conn, $cpfcnpj);
    $email = mysqli_real_escape_string($conn, $email);
    $telefone = mysqli_real_escape_string($conn, $telefone);

    $sql = "INSERT INTO usuario (nome, cpfcnpj, email, telefone) VALUES ('$nome', '$cpfcnpj', '$email', '$telefone')";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['mensagem'] = 'Usuário criado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi criado';
    }

    header('Location: ../index.php');
    exit;
}

// EDITAR USER

if (isset($_POST['update_usuario'])) {
    $usuario_id = mysqli_real_escape_string($conn, $_POST['usuario_id']);

    $nome = trim($_POST['nome']);
    $cpfcnpj = trim($_POST['cpfcnpj']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);

    if (empty($nome) || empty($cpfcnpj) || empty($email) || empty($telefone)) {
        $_SESSION['mensagem'] = 'Preencha todos os campos obrigatórios.';
        header('Location: ../index.php');
        exit;
    }

    $nome = mysqli_real_escape_string($conn, $nome);
    $cpfcnpj = mysqli_real_escape_string($conn, $cpfcnpj);
    $email = mysqli_real_escape_string($conn, $email);
    $telefone = mysqli_real_escape_string($conn, $telefone);

    $sql = "UPDATE usuario SET nome='$nome', cpfcnpj='$cpfcnpj', email='$email', telefone='$telefone' WHERE id='$usuario_id'";
    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['mensagem'] = 'Usuário atualizado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi atualizado';
    }

    header('Location: ../index.php');
    exit;
}

// DELETE USER

if (isset($_POST['delete_usuario'])) {
    $usuario_id = mysqli_real_escape_string($conn, $_POST['delete_usuario']);

    $sql = "DELETE FROM usuario WHERE id = '$usuario_id'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['mensagem'] = 'Usuário deletado com sucesso';
    } else {
        $_SESSION['mensagem'] = 'Usuário não foi deletado';
    }

    header('Location: ../index.php');
    exit;
}
