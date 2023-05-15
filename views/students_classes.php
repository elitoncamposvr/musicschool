<div class="content">
	<div class="breadcrumb">
		<h2>Turmas</h2>
	</div>

	<div class="menu_data">
		<div class="menu_data--left">
			<a class="btn btn--data-menu" href="<?php echo BASE_URL; ?>studentsclasses/create">Novo</a>
		</div>
	</div>

	<?php if ($students_classes_list) : ?>
		<div class="table_header">
			<div class="table-25">Turma</div>
			<div class="table-70">Escola</div>
			<div class="table-5"></div>
		</div>

		<?php foreach ($students_classes_list as $classes) : ?>
			<div class="table_data">
				<div class="table-25"><span class="table-title-mobile">Nome da Turma:</span><?php echo $classes['series_name']; ?>&ordf; <?php echo $classes['name_class_students']; ?></div>
				<div class="table-70"><span class="table-title-mobile">Escola:</span><?php echo $classes['school_name']; ?></div>
				<div class="table-5 table-options txt-right">
					<div class="dropdown">
						<i class="fas fa-ellipsis-h dropbtn" onclick="myFunction(this);"></i>
						<div id="myDropdown1" class="dropdown-content">

							<ul>
								<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>studentsclasses/students/<?php echo $classes['id']; ?>"><i class="fa-solid fa-graduation-cap"></i> Alunos</a></li>
								<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>studentsclasses/update/<?php echo $classes['id']; ?>"><i class="fas fa-edit"></i> Editar</a></li>
								<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>studentsclasses/destroy/<?php echo $classes['id']; ?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fas fa-trash-alt"></i> Deletar</a></li>
							</ul>

						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>

		<!-- Paginação (Pagination) -->
		<?php if ($p_count > 1) { ?>
			<div class="pagination">
				<a class="pag_item" href="<?php echo BASE_URL; ?>studentsclasses?p=1">Primeira</a>
				<?php
				for ($q = $p - 3; $q <= $p - 1; $q++) {
					if ($q >= 1) { ?>
						<a class="pag_item" href="<?php echo BASE_URL; ?>studentsclasses?p=<?php echo $q; ?>"><?php echo $q; ?></a>
				<?php }
				} ?>
				<div class="pag_item pag_active"><?php echo "$q"; ?></div>
				<?php for ($q = $p + 1; $q <= $p + 3; $q++) {
					if ($q <= $p_count) { ?>
						<a class="pag_item" href="<?php echo BASE_URL; ?>studentsclasses?p=<?php echo $q; ?>"><?php echo $q; ?></a>
				<?php }
				}
				?>
				<a class="pag_item" href="<?php echo BASE_URL; ?>studentsclasses?p=<?php echo $p_count; ?>">Última</a>
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