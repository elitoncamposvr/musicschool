<div class="content">
	<div class="breadcrumb">
		<h2>Avaliações</h2>
	</div>


	<!-- Cabeçalho da Tabela (Table Header) -->
	<?php if ($students_list) : ?>
		<div class="table_header">
			<div class="w-35">Nome do Aluno</div>
			<div class="w-10">Série</div>
			<div class="w-15">Turma</div>
			<div class="w-20">Escola</div>
			<div class="w-15">Avaliação</div>
			<div class="w-5"></div>
		</div>


		<!-- Dados da Tabela (Table Data) -->
		<?php foreach ($students_list as $st) : ?>
			<div class="table_data">
				<div class="table-35"><span class="table-title-mobile">Nome do Aluno:</span><?php echo $st['student_name']; ?></div>
				<div class="table-10"><span class="table-title-mobile">Série:</span><?php echo $st['series_name']; ?>&ordf;</div>
				<div class="table-15"><span class="table-title-mobile">Turma:</span><?php echo $st['class_name']; ?></div>
				<div class="table-20"><span class="table-title-mobile">Escola:</span><?php echo $st['school_name']; ?></div>
				<div class="table-15">
					<span class="table-title-mobile">Avaliação:</span>
					<?php if ($st['evaluation_stage'] < 1) {
						echo '<span class="badge badge-pending">Pendente</span>';
					} elseif ($st['evaluation_stage'] < 5) {
						echo '<span class="badge badge-aproved">Em andamento</span>';
					} else {
						echo '<span class="badge badge-success">Concluído</span>';
					} ?>
				</div>
				<div class="table-5 table-options txt-right">
					<div class="dropdown">
						<i class="fas fa-ellipsis-h dropbtn" onclick="myFunction(this);"></i>
						<div id="myDropdown1" class="dropdown-content">
							<ul>
								<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>students/evaluation/<?php echo $st['id']; ?>"><i class="fa-solid fa-clipboard-question"></i> Avaliação</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>


		<!-- Paginação (Pagination) -->
		<?php if ($p_count > 1) { ?>
			<div class="pagination">
				<a class="pag_item" href="<?php echo BASE_URL; ?>students?p=1">Primeira</a>
				<?php
				for ($q = $p - 5; $q <= $p - 1; $q++) {
					if ($q >= 1) { ?>
						<a class="pag_item" href="<?php echo BASE_URL; ?>students?p=<?php echo $q; ?>"><?php echo $q; ?></a>
				<?php }
				} ?>
				<div class="pag_item pag_active"><?php echo "$q"; ?></div>
				<?php for ($q = $p + 1; $q <= $p + 5; $q++) {
					if ($q <= $p_count) { ?>
						<a class="pag_item" href="<?php echo BASE_URL; ?>students?p=<?php echo $q; ?>"><?php echo $q; ?></a>
				<?php }
				}
				?>
				<a class="pag_item" href="<?php echo BASE_URL; ?>students?p=<?php echo $p_count; ?>">Última</a>
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