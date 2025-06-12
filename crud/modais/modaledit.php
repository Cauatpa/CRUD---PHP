    <!-- Modal de Edição -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editUserForm" action="acoes/acoes.php" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="usuario_id" id="editUsuarioId">
                        <div class="mb-3">
                            <label for="editNome" class="form-label">Nome</label>
                            <input type="text" name="nome" id="editNome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCpfcnpj" class="form-label">CPF/CNPJ</label>
                            <input type="text" name="cpfcnpj" id="editCpfcnpj" class="form-control" required pattern="\d{11}|\d{14}">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" name="email" id="editEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTelefone" class="form-label">Telefone</label>
                            <input type="tel" name="telefone" id="editTelefone" class="form-control" required pattern="\d{10,11}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="update_usuario" class="btn btn-success">Atualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>