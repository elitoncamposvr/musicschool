<div class="content">
	<div class="breadcrumb">
		<h2>Aluno<i class="fas fa-angle-right fa-xs"></i>Resultados da Pesquisa</h2>

		<span>
			<a href="<?php echo BASE_URL; ?>students"><i class="fas fa-angle-double-left"></i> Voltar</a>
		</span>
	</div>

	<!-- Botões (Buttons) -->
	<div class="menu_data">
		<div class="menu_data--left">
			<div>
				<a class="btn btn--data-menu" href="<?php echo BASE_URL; ?>students/create">Novo</a>
			</div>
		</div>
		<div class="menu_data--right">
			<form class="form-search-right" action="<?php echo BASE_URL; ?>students/search">
				<span class="mb-2 w-100"><input type="text" class="w-100" name="sp" id="sp" placeholder="Pesquisar Aluno" required></span>
			</form>
		</div>
	</div>

	<!-- Cabeçalho da Tabela (Table Header) -->
	<?php if ($students) : ?>
		<div class="table_header">
			<div class="w-35">Nome do Aluno</div>
			<div class="w-10">Série</div>
			<div class="w-15">Turma</div>
			<div class="w-20">Escola</div>
			<div class="w-15">Avaliação</div>
			<div class="w-5"></div>
		</div>


		<!-- Dados da Tabela (Table Data) -->
		<?php foreach ($students as $c) : ?>
			<div class="table_data">
				<div class="table-35"><span class="table-title-mobile">Nome do Aluno:</span><?php echo $c['student_name']; ?></div>
				<div class="table-10"><span class="table-title-mobile">Série:</span><?php echo $c['series_name']; ?>&ordf;</div>
				<div class="table-15"><span class="table-title-mobile">Turma:</span><?php echo $c['name_class_students']; ?></div>
				<div class="table-20"><span class="table-title-mobile">Escola:</span><?php echo $c['school_name']; ?></div>
				<div class="table-15">
					<span class="table-title-mobile">Avaliação:</span>
					<?php if ($c['evaluation_stage'] < 1) {
						echo '<span class="badge badge-pending">Pendente</span>';
					} elseif ($c['evaluation_stage'] < 5) {
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
								<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>students/update/<?php echo $c['id']; ?>"><i class="fas fa-edit"></i> Editar</a></li>
								<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>students/destroy/<?php echo $c['id']; ?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fas fa-trash-alt"></i> Deletar</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>


	<?php else : ?>
		<div class="flash_info my-2">
			<p><i class="fas fa-exclamation-circle fa-2x px"></i></p><span>Nenhum registro encontrado!</span>
		</div>
		<div class="search_pg">
			<form class="w-100" action="<?php echo BASE_URL; ?>students/search">
				<p class="mb-l">Refaça sua pesquisa</p>
				<span class="mb-2"><input type="text" class="input-field-search" name="sp" id="sp" placeholder="Pesquisar Aluno" required></span>
				<span><button type="submit"><i class="fas fa-search"></i> Pesquisar</button></span>
			</form>
		</div>
	<?php endif; ?>

</div>

<!-- Script Dropdown Itens -->
<script src="<?php echo BASE_URL; ?>assets/js/dropdown_itens.js"></script>