<?php
session_start();
require '../conexao/conexao.php';

// CRIAR USUÁRIO
if (isset($_POST['create_usuario'])) {
    $nome = trim($_POST['nome']);
    $cpfcnpj = preg_replace('/\D/', '', $_POST['cpfcnpj']);
    $email = trim($_POST['email']);
    $telefone = preg_replace('/\D/', '', $_POST['telefone']);

    if (empty($nome) || empty($cpfcnpj) || empty($email) || empty($telefone)) {
        $_SESSION['mensagem'] = 'Preencha todos os campos obrigatórios.';
        $_SESSION['mensagem_tipo'] = 'danger';
        header('Location: ../index.php');
        exit;
    }

    $nome = mysqli_real_escape_string($conn, $nome);
    $cpfcnpj = mysqli_real_escape_string($conn, $cpfcnpj);
    $email = mysqli_real_escape_string($conn, $email);
    $telefone = mysqli_real_escape_string($conn, $telefone);

    // Verifica se email ou CPF/CNPJ já existem
    $verifica_sql = "SELECT id FROM usuario WHERE email = '$email' OR cpfcnpj = '$cpfcnpj' LIMIT 1";
    $resultado = mysqli_query($conn, $verifica_sql);

    if (mysqli_num_rows($resultado) > 0) {
        $_SESSION['mensagem'] = "Erro: Email ou CPF/CNPJ já cadastrado!";
        $_SESSION['mensagem_tipo'] = 'danger';
        header('Location: ../index.php');
        exit;
    }

    $sql = "INSERT INTO usuario (nome, cpfcnpj, email, telefone) VALUES ('$nome', '$cpfcnpj', '$email', '$telefone')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = 'Usuário criado com sucesso!';
        $_SESSION['mensagem_tipo'] = 'success';
    } else {
        $_SESSION['mensagem'] = 'Erro ao criar usuário.';
        $_SESSION['mensagem_tipo'] = 'danger';
    }

    header('Location: ../index.php');
    exit;
}

// EDITAR USUÁRIO
if (isset($_POST['update_usuario'])) {
    $usuario_id = mysqli_real_escape_string($conn, $_POST['usuario_id']);
    $nome = trim($_POST['nome']);
    $cpfcnpj = preg_replace('/\D/', '', $_POST['cpfcnpj']);
    $email = trim($_POST['email']);
    $telefone = preg_replace('/\D/', '', $_POST['telefone']);

    if (empty($nome) || empty($cpfcnpj) || empty($email) || empty($telefone)) {
        $_SESSION['mensagem'] = 'Preencha todos os campos obrigatórios.';
        $_SESSION['mensagem_tipo'] = 'danger';
        header('Location: ../index.php');
        exit;
    }

    $nome = mysqli_real_escape_string($conn, $nome);
    $cpfcnpj = mysqli_real_escape_string($conn, $cpfcnpj);
    $email = mysqli_real_escape_string($conn, $email);
    $telefone = mysqli_real_escape_string($conn, $telefone);

    // Verifica se outro usuário já tem o mesmo email ou CPF/CNPJ
    $verifica_sql = "SELECT id FROM usuario WHERE (email = '$email' OR cpfcnpj = '$cpfcnpj') AND id != '$usuario_id' LIMIT 1";
    $resultado = mysqli_query($conn, $verifica_sql);

    if (mysqli_num_rows($resultado) > 0) {
        $_SESSION['mensagem'] = "Erro: Email ou CPF/CNPJ já estão em uso por outro usuário.";
        $_SESSION['mensagem_tipo'] = 'danger';
        header('Location: ../index.php');
        exit;
    }

    $sql = "UPDATE usuario SET nome = '$nome', cpfcnpj = '$cpfcnpj', email = '$email', telefone = '$telefone' WHERE id = '$usuario_id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = 'Usuário atualizado com sucesso!';
        $_SESSION['mensagem_tipo'] = 'success';
    } else {
        $_SESSION['mensagem'] = 'Erro ao atualizar usuário.';
        $_SESSION['mensagem_tipo'] = 'danger';
    }

    header('Location: ../index.php');
    exit;
}

// DELETAR USUÁRIO
if (isset($_POST['delete_usuario'])) {
    $usuario_id = mysqli_real_escape_string($conn, $_POST['delete_usuario']);

    $sql = "DELETE FROM usuario WHERE id = '$usuario_id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['mensagem'] = 'Usuário deletado com sucesso!';
        $_SESSION['mensagem_tipo'] = 'success';
    } else {
        $_SESSION['mensagem'] = 'Erro ao deletar usuário.';
        $_SESSION['mensagem_tipo'] = 'danger';
    }

    header('Location: ../index.php');
    exit;
}
