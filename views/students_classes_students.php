<div class="content">
    <div class="breadcrumb">
        <h2>Turmas<i class="fas fa-angle-right fa-xs"></i>Listar Alunos</h2>
        <span>
            <a href="<?php echo BASE_URL; ?>studentsclasses"><i class="fas fa-angle-double-left"></i> Voltar</a>
        </span>
    </div>

    <!-- Cabeçalho Tabela (Table Header) -->
    <?php if ($classes_students) : ?>
        <div class="table_header">
            <div class="table-35">Nome</div>
            <div class="table-10">Série</div>
            <div class="table-20">Turma</div>
            <div class="table-35">Escola</div>
        </div>

        <!-- Dados da Tabela (Data Table)-->
        <?php foreach ($classes_students as $classes) : ?>
            <div class="table_data">
                <div class="table-35"><span class="table-title-mobile">Nome do Aluno:</span><?php echo $classes['student_name']; ?></div>
                <div class="table-10"><span class="table-title-mobile">Série do Aluno:</span><?php echo $classes['series_name']; ?>&ordf;</div>
                <div class="table-20"><span class="table-title-mobile">Nome da Turma:</span><?php echo $classes['class_name']; ?></div>
                <div class="table-35"><span class="table-title-mobile">Local:</span><?php echo $classes['school_name']; ?></div>
            </div>
        <?php endforeach; ?>

    <?php else : ?>
        <div class="flash_info my-x">
            <p><i class="fas fa-exclamation-circle fa-2x px"></i></p><span>Nenhum registro encontrado!</span>
        </div>
    <?php endif; ?>

</div>

<!-- Script Dropdown Itens -->
<script src="<?php echo BASE_URL; ?>assets/js/dropdown_itens.js"></script>