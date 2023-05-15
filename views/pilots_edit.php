<!-- Breadcrumbs -->
<div class="breadcrumb">
	<h2>Pilotos<i class="fas fa-angle-right fa-xs"></i>Editar</h2>

	<span>
		<a class="btn" href="<?php echo BASE_URL; ?>pilots"><i class="fas fa-angle-double-left"></i> Voltar</a>
	</span>
</div>

<div class="content">
	<!-- Message Error (Mensagem de Erro) -->
	<?php if (isset($error_msg) && !empty($error_msg)) : ?>
		<div class="flash_warning"><?php echo $error_msg; ?></div>
	<?php endif; ?>

	<!-- Formulário - Dados Pessoais (Form - Personal Data) -->
	<form method="POST" autocomplete="off">
		<div class="table-line">
			<div class="table-60 my-s space-input">
				<label for="fullname_pilot">Nome</label>
				<input class="w-100" type="text" name="fullname_pilot" value="<?php echo $pilots_info['fullname_pilot']; ?>" id="fullname_pilot" autofocus required>
			</div>
			<div class="table-40 my-s">
				<label for="nickname_pilot">Apelido</label>
				<input class="w-100" type="text" name="nickname_pilot" id="nickname_pilot" value="<?php echo $pilots_info['nickname_pilot']; ?>">
			</div>
		</div>

		<!-- Documentos Pessoais (Personal Documents) -->
		<div class="table-line">
			<div class="table-35 my-s space-input">
				<label for="cpf">CPF</label>
				<input class="cpf table-100" type="text" name="cpf" id="cpf" placeholder="CPF" value="<?php echo $pilots_info['cpf']; ?>">
			</div>
			<div class="table-35 my-s space-input">
				<label for="cellphone">Celular</label>
				<input class="w-100" type="text" name="cellphone" id="cellphone" value="<?php echo $pilots_info['cellphone']; ?>">
			</div>
			<div class="table-30 my-s">
				<label for="birth_date">Data Nascimento</label>
				<input class="w-100" type="date" name="birth_date" id="birth_date" value="<?php echo $pilots_info['birth_date']; ?>">
			</div>
		</div>

		<!-- Botões (Button) -->
		<div class="w-100 txt-center my-el">
			<button type="submit">
				Editar Piloto
			</button>
		</div>
	</form>
</div>

<!-- SCRIPTS JS -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/general_mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cep.js"></script>