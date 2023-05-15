<div class="content">
	<div class="breadcrumb">
		<h2>Alunos<i class="fas fa-angle-right fa-xs"></i>Adicionar</h2>

		<span>
			<a href="<?php echo BASE_URL; ?>students"><i class="fas fa-angle-double-left"></i> Voltar</a>
		</span>
	</div>


	<!-- Formulário - Dados Pessoais (Form - Personal Data) -->
	<form method="POST" autocomplete="off">
		<div class="table-line">
			<div class="table-70 my-s space-input">
				<label for="student_name">Nome do Aluno</label>
				<input class="table-100" type="text" name="student_name" id="student_name" required autofocus>
			</div>
			<div class="table-30 my-s">
				<label for="series_id">Série</label>
				<select name="series_id" id="series_id" class="table-100">
					<?php foreach ($series_list as $series) : ?>
						<option value="<?php echo $series['id']; ?>"><?php echo $series['series_name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<!-- Botões (Button) -->
		<div class="w-100 txt-center my-el">
			<button type="submit">
				Adicionar Aluno
			</button>
		</div>
	</form>
</div>