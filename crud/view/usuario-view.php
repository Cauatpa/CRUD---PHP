<?php
session_start();
require '../conexao/conexao.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuário - View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Visualizar usuário
                            <a href="../index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>

                    <div class="card-body">
                        <?php
                        if (isset($_GET['id']) && !empty($_GET['id'])) {
                            $usuario_id = mysqli_real_escape_string($conn, $_GET['id']);
                            $sql = "SELECT * FROM usuario WHERE id='$usuario_id'";
                            $query = mysqli_query($conn, $sql);

                            if (!$query) {
                                echo "<div class='alert alert-danger'>Erro na consulta: " . mysqli_error($conn) . "</div>";
                            } else if (mysqli_num_rows($query) > 0) {
                                $usuario = mysqli_fetch_assoc($query);
                        ?>
                                <div class="mb-3">
                                    <label>Nome</label>
                                    <p class="form-control"><?= htmlspecialchars($usuario['nome']) ?></p>
                                </div>

                                <div class="mb-3">
                                    <label>CPF/CNPJ</label>
                                    <p class="form-control">
                                        <?php
                                        $doc = preg_replace('/\D/', '', $usuario['cpfcnpj']);
                                        if (strlen($doc) === 11) {
                                            echo substr($doc, 0, 3) . '.' . substr($doc, 3, 3) . '.' . substr($doc, 6, 3) . '-' . substr($doc, 9, 2);
                                        } elseif (strlen($doc) === 14) {
                                            echo substr($doc, 0, 2) . '.' . substr($doc, 2, 3) . '.' . substr($doc, 5, 3) . '/' . substr($doc, 8, 4) . '-' . substr($doc, 12, 2);
                                        } else {
                                            echo htmlspecialchars($usuario['cpfcnpj']);
                                        }
                                        ?>
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <label>Email</label>
                                    <p class="form-control"><?= htmlspecialchars($usuario['email']) ?></p>
                                </div>

                                <div class="mb-3">
                                    <label>Telefone</label>
                                    <p class="form-control">
                                        <?php
                                        $tel = preg_replace('/\D/', '', $usuario['telefone']);
                                        if (strlen($tel) === 11) {
                                            echo '(' . substr($tel, 0, 2) . ') ' . substr($tel, 2, 5) . '-' . substr($tel, 7);
                                        } elseif (strlen($tel) === 10) {
                                            echo '(' . substr($tel, 0, 2) . ') ' . substr($tel, 2, 4) . '-' . substr($tel, 6);
                                        } else {
                                            echo htmlspecialchars($usuario['telefone']);
                                        }
                                        ?>
                                    </p>
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
</body>

</html>