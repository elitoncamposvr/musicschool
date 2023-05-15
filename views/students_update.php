<div class="content">
	<div class="breadcrumb">
		<h2>Alunos<i class="fas fa-angle-right fa-xs"></i>Editar</h2>
		<span>
			<a href="<?php echo BASE_URL; ?>students"><i class="fas fa-angle-double-left"></i> Voltar</a>
		</span>
	</div>

	<!-- Message Error (Mensagem de Erro) -->
	<?php if (isset($error_msg) && !empty($error_msg)) : ?>
		<div class="warning"><?php echo $error_msg; ?></div>
	<?php endif; ?>

	<!-- Formulário - Dados Pessoais (Form - Personal Data) -->
	<form method="POST">
		<div class="table-line">
			<div class="table-70 my-s wrap mr-m">
				<label for="student_name">Nome do Aluno</label>
				<input class="w-100" type="text" name="student_name" id="student_name" value="<?php echo $students_info['student_name']; ?>">
			</div>
			<div class="table-30 my-s wrap mr-m">
				<label for="series_id">Série</label>
				<label for="series_id">Série</label>
				<select name="series_id" id="series_id" class="table-100">
					<?php foreach ($series_list as $series) : ?>
						<option value="<?php echo $series['id']; ?>" <?php if ($series['id'] == $students_info['series_id']) {
																			echo 'selected="selected"';
																		}; ?>><?php echo $series['series_name']; ?>&ordf;</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>


		<!-- Botões (Button) -->
		<div class="w-100 txt-center my-el">
			<button type="submit">
				Editar Aluno
			</button>
		</div>
	</form>
</div>

<!-- SCRIPTS JS -->
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/general_mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/change_items.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/cep.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/script_price.js"></script>