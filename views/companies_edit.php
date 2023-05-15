<!-- Breadcrumbs -->
<div class="breadcrumb">
    <h2>Configurações<i class="fas fa-angle-right fa-xs"></i>Dados da Empresa<i class="fas fa-angle-right fa-xs"></i>Editar</h2>
    <span>
        <a class="btn" href="<?php echo BASE_URL; ?>companies"><i class="fas fa-angle-double-left"></i> Voltar</a>
    </span>
</div>

<div class="content">
	<!-- Formulário -->
	<form method="POST">
		<div class="w-100 flex">
			<div class="w-50 my-s mr-el">
				<label for="name">Nome da Empresa</label>
				<input type="text" class="w-100" name="name" id="name" value="<?php echo $viewData['company_name']; ?>" required>
			</div>
			<div class="w-50 my-s">
				<label for="social_reason">Razão Social</label>
				<input type="text" class="w-100" name="social_reason" id="social_reason" value="<?php echo $companies_info['social_reason']; ?>">
			</div>
		</div>
		<div class="w-100 flex">
			<div class="w-50 my-s mr-el">
				<label for="cnpj">CNPJ</label>
				<input type="text" class="w-100" name="cnpj" id="cnpj" value="<?php echo $companies_info['cnpj']; ?>" required>
			</div>
			<div class="w-50 my-s">
				<label for="state_registration">Inscrição Estadual</label>
				<input type="text" class="w-100" name="state_registration" id="state_registration" value="<?php echo $companies_info['state_registration']; ?>">
			</div>
		</div>
		<div class="w-100 flex">
			<div class="w-33 my-s mr-el">
				<label for="email">E-mail</label>
				<input type="text" class="w-100" name="email" id="email" value="<?php echo $companies_info['email']; ?>" required>
			</div>
			<div class="w-33 my-s mr-el">
				<label for="site">Website</label>
				<input type="text" class="w-100" name="site" id="site" value="<?php echo $companies_info['site']; ?>">
			</div>
			<div class="w-33 my-s">
				<label for="phone">Telefone</label>
				<input type="text" class="w-100" name="phone" id="phone" value="<?php echo $companies_info['phone']; ?>">
			</div>
		</div>

		<!-- Endereço (Adress) -->
		<h2 class="spt my-s">Endereço</h2>
		<div class="w-100 flex">
			<div class="w-25 my-s mr-el">
				<label for="address_zipcode">CEP</label>
				<input type="text" class="w-100" name="address_zipcode" id="address_zipcode" onblur="pesquisacep(this.value);" value="<?php echo $companies_info['address_zipcode']; ?>">
			</div>
			<div class="w-50 my-s mr-el">
				<label for="address">Endereço</label>
				<input class="w-100" type="text" name="address" id="address" value="<?php echo $companies_info['address']; ?>">
			</div>
			<div class="w-25 my-s">
				<label for="address_number">Número</label>
				<input class="w-100" type="text" name="address_number" id="address_number" value="<?php echo $companies_info['address_zipcode']; ?>">
			</div>
		</div>
		<div class="w-100 flex">
			<div class="w-35 my-s mr-el">
				<label for="address2">Complemento</label>
				<input type="text" class="w-100" name="address2" id="address2" value="<?php echo $companies_info['address2']; ?>">
			</div>
			<div class="w-25 my-s mr-el">
				<label for="address_neighb">Bairro</label>
				<input type="text" class="w-100" name="address_neighb" id="address_neighb" value="<?php echo $companies_info['address_neighb']; ?>">
			</div>
			<div class="w-25 my-s mr-el">
				<label for="address_city">Cidade</label>
				<input type="text" class="w-100" name="address_city" id="address_city" value="<?php echo $companies_info['address_city']; ?>">
			</div>
			<div class="w-15 my-s">
				<label for="address_state">UF</label>
				<input type="text" class="w-100" name="address_state" id="address_state" value="<?php echo $companies_info['address_state']; ?>">
			</div>
		</div>


		<!-- Botão (Button) -->
		<div class="w-100 txt-center my-el">
			<button type="submit">
				Editar Dados
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