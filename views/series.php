<div class="content">
    <div class="breadcrumb">
        <h2>Séries</h2>
    </div>

    <!-- Botões (Buttons) -->
    <div class="menu_data">
        <div class="menu_data--left">
            <a class="btn btn--data-menu" href="<?php echo BASE_URL; ?>series/create">Novo</a>
        </div>
    </div>

    <!-- Cabeçalho Tabela (Table Header) -->
    <?php if ($series_list) : ?>
        <div class="table_header">
            <div class="table-15">Série</div>
            <div class="table-80">Escola</div>
            <div class="table-5"></div>
        </div>

        <!-- Dados da Tabela (Data Table)-->
        <?php foreach ($series_list as $series) : ?>
            <div class="table_data">
                <div class="table-15"><span class="table-title-mobile">Série:</span><?php echo $series['series_name']; ?>&ordf;</div>
                <div class="table-80"><span class="table-title-mobile">Escola:</span><?php echo $series['school_name']; ?></div>
                <div class="table-5 table-options txt-right">
                    <div class="dropdown">
                        <i class="fas fa-ellipsis-h dropbtn" onclick="myFunction(this);"></i>
                        <div id="myDropdown1" class="dropdown-content">

                            <ul>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>series/update/<?php echo $series['id']; ?>"><i class="fas fa-edit"></i> Editar</a></li>
                                <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>series/destroy/<?php echo $series['id']; ?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fas fa-trash-alt"></i> Deletar</a></li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Paginação (Pagination) -->
        <?php if ($p_count > 1) { ?>
            <div class="pagination">
                <a class="pag_item" href="<?php echo BASE_URL; ?>series?p=1">Primeira</a>
                <?php
                for ($q = $p - 3; $q <= $p - 1; $q++) {
                    if ($q >= 1) { ?>
                        <a class="pag_item" href="<?php echo BASE_URL; ?>series?p=<?php echo $q; ?>"><?php echo $q; ?></a>
                <?php }
                } ?>
                <div class="pag_item pag_active"><?php echo "$q"; ?></div>
                <?php for ($q = $p + 1; $q <= $p + 3; $q++) {
                    if ($q <= $p_count) { ?>
                        <a class="pag_item" href="<?php echo BASE_URL; ?>series?p=<?php echo $q; ?>"><?php echo $q; ?></a>
                <?php }
                }
                ?>
                <a class="pag_item" href="<?php echo BASE_URL; ?>series?p=<?php echo $p_count; ?>">Última</a>
            </div>
        <?php } ?>


    <?php else : ?>
        <div class="flash_info my-x">
            <p><i class="fas fa-exclamation-circle fa-2x px"></i></p><span>Nenhum registro encontrado!</span>
        </div>
    <?php endif; ?>

</div>

<!-- Script Dropdown Itens -->
<script src="<?php echo BASE_URL; ?>assets/js/dropdown_itens.js"></script>