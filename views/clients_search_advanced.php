<div class="breadcrumb">
    <h2>Clientes<i class="fas fa-angle-right fa-xs"></i>Pesquisa Avançada</h2>

    <span>
        <a class="btn" href="<?php echo BASE_URL; ?>clients"><i class="fas fa-angle-double-left"></i> Voltar</a>
    </span>
</div>

<div class="content">

    <!-- Cabeçalho da Tabela (Table Header) -->

    <div class="search_pg">
        <form class="w-100" action="<?php echo BASE_URL; ?>clients/search">
            <p class="mb-l">Pesquisar Cliente</p>
            <span class="mb-2">
                <input type="text" class="input-field-search" name="sp" id="cpf" placeholder="Pesquisar CPF do Cliente" required>
            </span>
            <span>
                <button type="submit"><i class="fas fa-search"></i> Pesquisar</button>
            </span>
        </form>
    </div>


    <!-- Script Dropdown Itens -->
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/general_mask.js"></script>