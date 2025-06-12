<?php
session_start();
require 'conexao/conexao.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-4">
        <?php include('createusuario/mensagem.php'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- Titulo + ADD user -->
                    <div class="card-header">
                        <h4>Lista de Usuários
                            <a href="createusuario/usuario-create.php" class="btn btn-primary float-end">Adicionar usuário</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <!-- HEAD  -->
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>CPF/CNPJ</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>

                            <!-- BODY  -->
                            <tbody>
                                <?php
                                $sql = 'SELECT * FROM usuario';
                                $usuarios = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($usuarios) > 0) {
                                    foreach ($usuarios as $usuario) {
                                ?>
                                        <tr>
                                            <td><?= $usuario['id'] ?></td>
                                            <td><?= $usuario['nome'] ?></td>
                                            <td>
                                                <?php
                                                $doc = preg_replace('/\D/', '', $usuario['cpfcnpj']);

                                                if (strlen($doc) === 11) {
                                                    echo substr($doc, 0, 3) . '.' . substr($doc, 3, 3) . '.' . substr($doc, 6, 3) . '-' . substr($doc, 9, 2);
                                                } elseif (strlen($doc) === 14) {
                                                    echo substr($doc, 0, 2) . '.' . substr($doc, 2, 3) . '.' . substr($doc, 5, 3) . '/' . substr($doc, 8, 4) . '-' . substr($doc, 12, 2);
                                                } else {
                                                    echo $usuario['cpfcnpj'];
                                                }
                                                ?>
                                            </td>

                                            <td><?= $usuario['email'] ?></td>
                                            <td>
                                                <?php
                                                $tel = preg_replace('/\D/', '', $usuario['telefone']);

                                                if (strlen($tel) === 11) {
                                                    echo '(' . substr($tel, 0, 2) . ') ' . substr($tel, 2, 5) . '-' . substr($tel, 7);
                                                } elseif (strlen($tel) === 10) {
                                                    echo '(' . substr($tel, 0, 2) . ') ' . substr($tel, 2, 4) . '-' . substr($tel, 6);
                                                } else {
                                                    echo $usuario['telefone'];
                                                }
                                                ?>
                                            </td>

                                            <!-- Ações -->
                                            <td>
                                                <a href="acoes/usuario-view.php?id=<?= $usuario['id'] ?>" class="btn btn-secondary btn-sm"><span class="bi-eye-fill"></span>&nbsp; Visualizar</a>
                                                <a href="acoes/usuario-edit.php?id=<?= $usuario['id'] ?>" class="btn btn-success btn-sm"><span class="bi-pencil-fill"></span>&nbsp; Editar</a>
                                                <form action="acoes/acoes.php" method="POST" class="d-inline">
                                                    <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_usuario" value="<?= $usuario['id'] ?>" class="btn btn-danger btn-sm"><span class="bi-trash3-fill"></span>&nbsp; Excluir</button>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="6" class="text-center">Nenhum usuário encontrado</td></tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>