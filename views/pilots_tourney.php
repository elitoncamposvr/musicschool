<!-- Breadcrumbs -->
<div class="breadcrumb">
	<h2>Pilotos<i class="fas fa-angle-right fa-xs"></i>Inscrição em Campeonatos</h2>

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
				<div class="w-100 bold txt-up"><?php echo $pilots_info['id']; ?> - <?php echo $pilots_info['fullname_pilot']; ?></div>
			</div>
			<div class="table-40 my-s">
				<label for="nickname_pilot">Apelido</label>
				<div class="w-100 bold txt-up"><?php echo $pilots_info['nickname_pilot']; ?></div>
			</div>
		</div>

		<div class="table-100 wrap btw flex">
			<input type="hidden" name="pilot" value="<?php echo $pilots_info['id']; ?>">
			<?php foreach ($tourney_list as $p) : ?>
				<div class="table-30 p-l m-s mb-m rounded-m bg_positive">
					<label for="p_<?php echo $p['id']; ?>">
						<p>
							<input type="checkbox" name="tourneys[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>" <?php echo (in_array($p['id'], $pilots_info['tourney_registration'])) ? 'checked="checked"' : ''; ?> />
							<?php echo $p['name_tourney']; ?> (<?php echo $p['local_tourney']; ?>)
							a
						</p>
					</label>
				</div>
			<?php endforeach; ?>
		</div>

		<!-- Botões (Button) -->
		<div class="w-100 txt-center my-el">
			<button type="submit">
				Confirmar Inscrição
			</button>
		</div>
	</form>
</div>

<!-- SCRIPTS JS -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/general_mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cep.js"></script>