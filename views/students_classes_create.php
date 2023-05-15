<div class="content">
    <div class="breadcrumb">
        <h2>Turmas <i class="fas fa-angle-right fa-xs"></i>Adicionar</h2>
        <span>
            <a href="<?php echo BASE_URL; ?>studentsclasses"><i class="fas fa-angle-double-left"></i> Voltar</a>
        </span>
    </div>

    <!-- Formulário (Add Form) -->
    <form method="POST">
        <div class="table-line my-s">
            <div class="table-100 space-input">
                <label for="series_id">Série</label>
                <select class="table-100" name="series_id" id="series_id">
                    <?php foreach ($series_list as $series) : ?>
                        <option value="<?php echo $series['id']; ?>"><?php echo $series['series_name']; ?>&ordf;</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="table-100">
                <label for="name_class_students">Nome da Turma</label>
                <input class="w-100" type="text" name="name_class_students" id="name_class_students" autofocus>
            </div>
        </div>

        <!-- Botão (Button) -->
        <button type="submit" class="my-el">
            Adicionar Turma
        </button>
    </form>
</div>