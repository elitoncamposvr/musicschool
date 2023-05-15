<!-- Breadcrumbs -->
<div class="breadcrumb">
    <h2>Configurações<i class="fas fa-angle-right fa-xs"></i>Usuários<i class="fas fa-angle-right fa-xs"></i>Grupo de Permissões<i class="fas fa-angle-right fa-xs"></i>Editar Grupo</h2>
    <span>
        <a class="btn" href="<?php echo BASE_URL; ?>users/permissions_group"><i class="fas fa-angle-double-left"></i> Voltar</a>
    </span>
</div>

<div class="content">
	<!-- Formulário de Adição (Add Form) -->
	<form method="POST">
		<div class="w-50 my-s">
			<label for="name">Nome do grupo de permissões</label>
			<input class="w-100" type="text" name="name" id="name" value="<?php echo $group_info['name']; ?>" required>
		</div>

		<div class="w-100 wrap btw flex">
			<?php foreach ($permissions_list as $p) : ?>
				<div class="w-30 p-l m-s rounded-m bg_white mb-m">
					<label for="p_<?php echo $p['id']; ?>">
						<p class="bold"><input type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>"<?php echo (in_array($p['id'], $group_info['params'])) ? 'checked="checked"' : ''; ?> /> <?php echo $p['permission_title']; ?></p><div class="rounded-m p-s mt-s bg_lt_gray"><?php echo $p['name']; ?></div>
					</label>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- Botões (Button) -->
		<div class="w-100 my-el">
			<button type="submit">
				Editar Grupo Permissão
			</button>
		</div>
	</form>
</div>