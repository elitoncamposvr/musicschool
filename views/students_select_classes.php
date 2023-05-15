<div class="content">
    <div class="breadcrumb">
        <h2>Alunos<i class="fas fa-angle-right fa-xs"></i>Selecionar Classe</h2>

        <span>
            <a href="<?php echo BASE_URL; ?>students"><i class="fas fa-angle-double-left"></i> Voltar</a>
        </span>
    </div>

    <!-- Formulário - Dados Pessoais (Form - Personal Data) -->
    <form method="POST" autocomplete="off">
        <div class="table-line">
            <div class="table-50 my-s space-input">
                <div class="bold">Aluno: </div>
                <?php echo $students_info['student_name']; ?>
            </div>
            <div class="table-20 my-s">
                <div class="bold">Série: </div>
                <?php echo $students_info['series_name']; ?>&ordf;
            </div>
            <div class="table-30 my-s">
                <label for="student_class_id">Turma</label>
                <select name="student_class_id" id="student_class_id" class="table-100">
                    <?php foreach ($series_list as $series) : ?>
                        <option value="<?php echo $series['id']; ?>"><?php echo $series['name_class_students']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <!-- Botões (Button) -->
        <div class="w-100 txt-center my-el">
            <button type="submit">
                Selecionar Classe
            </button>
        </div>
    </form>
</div>