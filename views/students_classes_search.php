
<div class="content">
	<!-- Breadcrumbs -->
	<div class="breadcrumb">
		<h2>Turmas<i class="fas fa-angle-right fa-xs"></i>Resultado da Pesquisa</h2>
		<span>
			<a href="<?php echo BASE_URL; ?>studentsclasses"><i class="fas fa-angle-double-left"></i> Voltar</a>
		</span>
	</div>

	<!-- Botões -->
	<div class="menu_data">
		<div class="menu_data--left">
				<div>
					<a class="btn btn--data-menu" href="<?php echo BASE_URL; ?>studentsclasses/create">Novo</a>
				</div>
		</div>
		<div class="menu_data--right">
			<form class="form-search-right" action="<?php echo BASE_URL; ?>studentsclasses/search">
				<span class="mb-2 w-100"><input type="text" class="w-100" name="sp" id="sp" placeholder="Pesquisar Turma" required></span>
			</form>
		</div>
	</div>

	<!-- Cabeçalho Tabela (Table Header) -->
	<?php if ($classes_list) : ?>
		<div class="table_header">
			<div class="table-50">Nome da Turma</div>
			<div class="table-45">Escola</div>
			<div class="table-5"></div>
		</div>

		<!-- Dados da Tabela (Data Table)-->
		<?php foreach ($classes_list as $classes) : ?>
			<div class="table_data">
				<div class="table-50"><span class="table-title-mobile">Nome da Turma:</span><?php echo $classes['name_class_students']; ?></div>
				<div class="table-45"><span class="table-title-mobile">Escola:</span><?php echo $classes['school_name']; ?></div>
				<div class="table-5 table-options txt-right">
					<div class="dropdown">
						<i class="fas fa-ellipsis-h dropbtn" onclick="myFunction(this);"></i>
						<div id="myDropdown1" class="dropdown-content">

							<ul>
								<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>studentsclasses/update/<?php echo $classes['id']; ?>"><i class="fas fa-edit"></i> Editar</a></li>
								<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>studentsclasses/destroy/<?php echo $classes['id']; ?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fas fa-trash-alt"></i> Deletar</a></li>
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
			<form class="w-100" action="<?php echo BASE_URL; ?>studentsclasses/search">
				<p class="mb-l">Refaça sua pesquisa</p>
				<span class="mb-2"><input type="text" class="input-field-search" name="sp" id="sp" placeholder="Pesquisar Turma" required></span>
				<span><button type="submit"><i class="fas fa-search"></i> Pesquisar</button></span>
			</form>
		</div>
	<?php endif; ?>

</div>

<!-- Script Dropdown Itens -->
<script src="<?php echo BASE_URL; ?>assets/js/dropdown_itens.js"></script>