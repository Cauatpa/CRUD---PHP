    <!-- Modal de Criação -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form id="userForm" action="acoes/acoes.php" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Adicionar Usuário</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="cpfcnpj" class="form-label">CPF/CNPJ</label>
                <input type="text" name="cpfcnpj" class="form-control" required pattern="\d{11}|\d{14}" title="Digite 11 (CPF) ou 14 (CNPJ) números.">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" name="telefone" class="form-control" required pattern="\d{10,11}" title="Telefone deve conter entre 10 e 11 números.">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="submit" name="create_usuario" class="btn btn-primary">Salvar</button>
            </div>
          </div>
        </form>
      </div>
    </div>