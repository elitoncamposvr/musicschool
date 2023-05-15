<div class="content">
	<div class="breadcrumb">
		<h2>Configurações<i class="fas fa-angle-right fa-xs"></i>Usuários<i class="fas fa-angle-right fa-xs"></i>Adicionar</h2>
		<span>
			<a href="<?php echo BASE_URL; ?>users"><i class="fas fa-angle-double-left"></i> Voltar</a>
		</span>
	</div>

	<!-- Formulário de Adição (Add Form) -->
	<form method="post">
		<div class="table-line">
			<div class="table-50 my-s space-input">
				<label for="name_user">Nome de Usuário</label>
				<input type="text" name="name_user" id="name_user" required class="w-100" autofocus>
			</div>
			<div class="table-50 my-s">
				<label for="email">E-mail</label>
				<input type="email" name="email" id="email" required class="w-100">
			</div>
		</div>
		<div class="table-line">
			<div class="table-50 my-s space-input">
				<label for="password">Senha</label>
				<input type="password" name="password" id="password" required class="w-100">
			</div>
			<div class="table-50 my-s">
				<label for="group">Grupo de Permissões</label>
				<select name="group" id="group" class="w-100">
					<?php foreach ($group_list as $g) : ?>
						<option value="<?php echo $g['id']; ?>"><?php echo $g['name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="table-center">
			<button type="submit" class="my-el">
				Adicionar Usuário
			</button>
		</div>
	</form>
</div>