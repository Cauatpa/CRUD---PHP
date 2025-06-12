<?php
session_start();
require '../conexao/conexao.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuário - Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <?php include '../navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar usuário
                            <a href="../index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $usuario_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $sql = "SELECT * FROM usuario WHERE id='$usuario_id'";
                            $query = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($query) > 0) {
                                $usuario = mysqli_fetch_array($query);
                        ?>
                                <form action="../acoes/acoes.php" method="POST">
                                    <input type="hidden" name="usuario_id" value="<?= $usuario['id'] ?>">

                                    <div class="mb-3">
                                        <label>Nome</label>
                                        <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>CPF/CNPJ</label>
                                        <input type="cpf" name="cpfcnpj" value="<?= htmlspecialchars($usuario['cpfcnpj']) ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label>Telefone</label>
                                        <input type="tel" name="telefone" value="<?= htmlspecialchars($usuario['telefone']) ?>" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <button type="submit" name="update_usuario" class="btn btn-primary">Salvar</button>
                                    </div>
                                </form>
                        <?php
                            } else {
                                echo "<h5>Usuário não encontrado</h5>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>