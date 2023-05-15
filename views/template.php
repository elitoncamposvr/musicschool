<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8'>
	<meta lang="pt-br">
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Enfance - Painel de Controle</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>assets/images/favicon.ico" />
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/fonts/fontawesome/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/mobile.css" />

	<!-- Jquery JS-->
	<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/jquery-3.4.0.min.js"></script>
	<script type="text/javascript">
		var BASE_URL = '<?php echo BASE_URL; ?>';
	</script>
</head>

<body>
	<div class="container">
		<header>
			<nav>
				<div class="open-menu" onclick="openMenu()"><i class="fa-solid fa-bars fa-lg"></i></div>
				<div class="logo">Enfance</div>
				<ul class="menu">
					<li><a href="<?php echo BASE_URL; ?>">Visão Geral</a></li>
					<li><a href="<?php echo BASE_URL; ?>series">Séries</a></li>
					<li><a href="<?php echo BASE_URL; ?>studentsclasses">Turmas</a></li>
					<li><a href="<?php echo BASE_URL; ?>students">Alunos</a></li>
					<li><a href="<?php echo BASE_URL; ?>evaluations">Avaliações</a></li>
				</ul>
				<span>
					<a href="<?php echo BASE_URL; ?>login/logout"><i class="fa-solid fa-right-from-bracket fa-lg"></i></a>
				</span>
			</nav>
		</header>
		<div class="main-content">
			<?php $this->loadViewInTemplate($viewName, $viewData); ?>
		</div>
	</div>

	<script src="<?php echo BASE_URL; ?>assets/js/main_script.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/dropdown_itens.js"></script>
</body>

</html>