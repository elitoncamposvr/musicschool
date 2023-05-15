<!-- Breadcrumbs -->
<div class="breadcrumb">
    <h2>Configurações<i class="fas fa-angle-right fa-xs"></i>Usuários<i class="fas fa-angle-right fa-xs"></i>Grupo de Permissões</h2>
    <span>
        <a class="btn" href="<?php echo BASE_URL; ?>settings/users"><i class="fas fa-angle-double-left"></i> Voltar</a>
    </span>
</div>

<div class="content">
    <!-- Botões -->
    <div class="menu_data">
        <p>
            <a class="btn" href="<?php echo BASE_URL; ?>users/permissions_add_group">Novo Grupo</a>
        </p>
        <p>
            <a class="btn" href="<?php echo BASE_URL; ?>users/permissions">Lista de Permissões</a>
        </p>
    </div>

    <!-- Cabeçalho da Tabela (Table Header) -->
    <div class="table_header">
        <div class="w-90">
            Grupo de Permissão
        </div>
        <div class="w-10">
        </div>
    </div>

    <!-- Dados Tabela (Table Data) -->
    <?php foreach ($permissions_groups_list as $p) : ?>
        <div class="table_data">
            <div class="w-90 txt-up">
                <?php echo $p['name']; ?>
            </div>
            <div class="w-10">
                <div class="dropdown">
                    <i class="fas fa-ellipsis-h dropbtn btn-awesome" onclick="myFunction(this);"></i>
                    <div id="myDropdown1" class="dropdown-content">
                        <ul>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>users/permissions_edit_group/<?php echo  $p['id']; ?>"><i class="fas fa-edit"></i> Editar</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>users/permissions_delete_group/<?php echo  $p['id']; ?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fas fa-trash-alt"></i> Deletar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Script Dropdown Itens -->
<script src="<?php echo BASE_URL; ?>assets/js/dropdown_itens.js"></script>