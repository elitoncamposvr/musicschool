<div class="content">
    <div class="breadcrumb">
        <h2>Séries <i class="fas fa-angle-right fa-xs"></i>Editar</h2>
        <span>
            <a href="<?php echo BASE_URL; ?>series"><i class="fas fa-angle-double-left"></i> Voltar</a>
        </span>
    </div>

    <!-- Formulário (Add Form) -->
    <form method="POST">
        <div class="table-line">
            <div class="table-100 my-s">
                <label for="series_name">Nome da Série</label>
                <input class="w-100" type="text" name="series_name" id="series_name" value="<?php echo $series_info['series_name']; ?>" autofocus>
            </div>
        </div>

        <!-- Botão (Button) -->
        <button type="submit" class="my-el">
            Editar Série
        </button>
    </form>
</div>