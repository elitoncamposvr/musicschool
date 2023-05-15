<div class="content">
	<div class="breadcrumb">
		<h2>Configurações<i class="fas fa-angle-right fa-xs"></i>Usuários<i class="fas fa-angle-right fa-xs"></i>Editar</h2>
		<span>
			<a href="<?php echo BASE_URL; ?>users"><i class="fas fa-angle-double-left"></i> Voltar</a>
		</span>
	</div>
	<!-- Mensagem de Erro (Error Message) -->
	<?php if (isset($error_msg) && !empty($error_msg)) : ?>
		<div class="flash_warning"><?php echo $error_msg; ?></div>
	<?php endif; ?>

	<div class="data_info">
		<p>
			<span class="bold">Usuário: </span><?php echo $user_info['email']; ?>
			<?php if ($user_info['status'] == '1') {
				echo '<span class="badge badge-success">Ativo</span>';
			} else {
				echo '<span class="badge badge-canceled">Bloqueado</span>';
			}
			?>
		</p>
		<span>
			<?php if ($user_info['status'] == '1') : ?>
				<a href="<?php echo BASE_URL; ?>users/block/<?php echo $user_info['id']; ?>" class="btn-sec">Bloquear</a>
			<?php else : ?>
				<a href="<?php echo BASE_URL; ?>users/unblock/<?php echo $user_info['id']; ?>" class="btn-sec">Desbloquear</a>
			<?php endif; ?>
		</span>
	</div>

	<!-- Formulário de Adição (Add Form) -->
	<form method="post">
		<div class="table-line">
			<div class="table-50 my-s space-input">
				<label for="name_user">Nome de Usuário</label>
				<input type="text" name="name_user" id="name_user" required class="w-100" value="<?php echo $user_info['name_user']; ?>" autofocus>
			</div>
			<div class="table-50 my-s">
				<label for="password">Senha</label>
				<input type="password" name="password" id="password" class="w-100">
			</div>
		</div>

		<div class="table-center">
			<button type="submit" class="my-el">
				Editar Usuário
			</button>
		</div>
	</form>
</div>