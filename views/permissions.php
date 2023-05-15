<!-- Breadcrumbs -->
<div class="breadcrumb">
    <h2>Configurações<i class="fas fa-angle-right fa-xs"></i>Usuários<i class="fas fa-angle-right fa-xs"></i>Permissões</h2>
    <span>
        <a class="btn" href="<?php echo BASE_URL; ?>settings/users"><i class="fas fa-angle-double-left"></i> Voltar</a>
    </span>
</div>

<div class="content">
	<!-- Botões -->
	<div class="menu_data">
		<p>
			<a class="btn" href="<?php echo BASE_URL; ?>users/permissions_add">Nova Permissão</a>
		</p>
		<p>
			<a class="btn" href="<?php echo BASE_URL; ?>users/permissions_group">Grupo de Permissões</a>
		</p>
	</div>

	<!-- Cabeçalho da Tabela (Table Header) -->
	<div class="table_header">
		<div class="w-50">
			Título da Permissão
		</div>
		<div class="w-40">
			Nome da Permissão
		</div>
		<div class="w-10">
		</div>
	</div>

	<!-- Dados Tabela (Table Data) -->
	<?php foreach ($permissions_list as $p) : ?>
		<div class="table_data">
			<div class="w-50 txt-up">
				<?php echo $p['permission_title']; ?>
			</div>
			<div class="w-40">
				<?php echo $p['name']; ?>
			</div>
			<div class="w-10">
				<a href="<?php echo BASE_URL; ?>users/permissions_delete/<?php echo $p['id']; ?>" onclick="return confirm('Deseja realmente excluir?')" title="Excluir"><i class="fas fa-trash-alt fa-lg"></i></a>
			</div>
		</div>
	<?php endforeach; ?>
</div>