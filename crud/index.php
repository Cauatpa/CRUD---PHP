<?php
session_start();
require 'conexao/conexao.php';
?>
<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <?php include('view/navbar.php'); ?>

    <div class="container mt-4">
        <?php if (isset($_SESSION['mensagem'])) : ?>
            <div class="alert alert-<?= $_SESSION['mensagem_tipo'] ?? 'success' ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['mensagem'];
                unset($_SESSION['mensagem'], $_SESSION['mensagem_tipo']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h4>Lista de Usuários
                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createUserModal">
                        Adicionar usuário
                    </button>
                </h4>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
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
                    <tbody>
                        <?php
                        $sql = 'SELECT * FROM usuario';
                        $usuarios = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($usuarios) > 0) {
                            foreach ($usuarios as $usuario) {
                        ?>
                                <tr>
                                    <td><?= $usuario['id'] ?></td>
                                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                                    <td>
                                        <?php
                                        $doc = preg_replace('/\D/', '', $usuario['cpfcnpj']);
                                        echo strlen($doc) === 11
                                            ? preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $doc)
                                            : (strlen($doc) === 14
                                                ? preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "$1.$2.$3/$4-$5", $doc)
                                                : htmlspecialchars($usuario['cpfcnpj']));
                                        ?>
                                    </td>
                                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                                    <td>
                                        <?php
                                        $tel = preg_replace('/\D/', '', $usuario['telefone']);
                                        echo strlen($tel) === 11
                                            ? preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $tel)
                                            : (strlen($tel) === 10
                                                ? preg_replace("/(\d{2})(\d{4})(\d{4})/", "($1) $2-$3", $tel)
                                                : htmlspecialchars($usuario['telefone']));
                                        ?>
                                    </td>
                                    <td>
                                        <a href="view/usuario-view.php?id=<?= $usuario['id'] ?>" class="btn btn-secondary btn-sm">
                                            <span class="bi-eye-fill"></span> Visualizar
                                        </a>
                                        <button
                                            class="btn btn-success btn-sm editar-btn"
                                            data-id="<?= $usuario['id'] ?>"
                                            data-nome="<?= htmlspecialchars($usuario['nome']) ?>"
                                            data-cpfcnpj="<?= htmlspecialchars($usuario['cpfcnpj']) ?>"
                                            data-email="<?= htmlspecialchars($usuario['email']) ?>"
                                            data-telefone="<?= htmlspecialchars($usuario['telefone']) ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editUserModal">
                                            <span class="bi-pencil-fill"></span> Editar
                                        </button>
                                        <form action="acoes/acoes.php" method="POST" class="d-inline">
                                            <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_usuario" value="<?= $usuario['id'] ?>" class="btn btn-danger btn-sm">
                                                <span class="bi-trash3-fill"></span> Excluir
                                            </button>
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

    <!-- Modais -->
    <?php include('modais/modalcreate.php'); ?>
    <?php include('modais/modaledit.php'); ?>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.editar-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('editUsuarioId').value = button.dataset.id;
                document.getElementById('editNome').value = button.dataset.nome;
                document.getElementById('editCpfcnpj').value = button.dataset.cpfcnpj;
                document.getElementById('editEmail').value = button.dataset.email;
                document.getElementById('editTelefone').value = button.dataset.telefone;
            });
        });
    </script>
</body>

</html>