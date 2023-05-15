<div class="content">
	<div class="breadcrumb">
		<h2>Configurações<i class="fas fa-angle-right fa-xs"></i>Usuários</h2>
		<a href="<?php echo BASE_URL; ?>settings"><i class="fas fa-angle-double-left"></i> Voltar</a>
	</div>

	<!-- Botões (Buttons) -->
	<div class="menu_data">
		<div class="menu_data--left">
			<div>
				<a class="btn btn--data-menu" href="<?php echo BASE_URL; ?>users/create">Novo</a>
			</div>
		</div>
	</div>

	<!-- Cabeçalho da Tabela (Table Header) -->
	<div class="table_header">
		<div class="table-25">Email/Login</div>
		<div class="table-30 txt-center">Nome</div>
		<div class="table-30 txt-center">Escola</div>
		<div class="table-10 txt-center">Satus</div>
		<div class="table-5"></div>
	</div>

	<!-- Dados da Tabela (Table Data) -->
	<?php foreach ($users_list as $us) : ?>
		<div class="table_data">
			<div class="table-25"><?php echo $us['email']; ?></div>
			<div class="table-30 txt-center"><?php echo $us['name_user']; ?></div>
			<div class="table-30 txt-center"><?php echo $us['school_id']; ?></div>
			<div class="table-10 txt-center">
				<?php if ($us['status'] == '1') {
					echo '<span class="badge badge-success">Ativo</span>';
				} else {
					echo '<span class="badge badge-canceled">Bloqueado</span>';
				}
				?>
			</div>
			<div class="table-5 table-options txt-right">
				<div class="dropdown">
					<i class="fas fa-ellipsis-h dropbtn" onclick="myFunction(this);"></i>
					<div id="myDropdown1" class="dropdown-content">
						<ul>
							<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>users/update/<?php echo $us['id']; ?>"><i class="fas fa-edit"></i> Editar</a></li>
							<li><a class="dropdown-item" href="<?php echo BASE_URL; ?>users/destroy/<?php echo $us['id']; ?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fas fa-trash-alt"></i> Deletar</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>

<!-- Script Dropdown Itens -->
<script src="<?php echo BASE_URL; ?>assets/js/dropdown_itens.js"></script>