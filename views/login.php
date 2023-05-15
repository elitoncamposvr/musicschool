<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Enfance - Entrar no Sistema</title>

  <!-- Meta -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo BASE_URL; ?>assets/images/favicon.ico">

  <!-- FontAwesome JS-->
  <script defer src="<?php echo BASE_URL; ?>assets/plugins/fontawesome/js/all.js"></script>

  <!-- App CSS -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/login.css" />
</head>

<body>
  <div class="container">
    <img src="<?php echo BASE_URL; ?>assets/images/logo.png" alt="Logo Enlace">
    <form method="POST">
      <?php if (isset($error) && !empty($error)) : ?>
        <div class="warning"><?php echo $error; ?></div>
      <?php endif; ?>
      <div id="warning_caps">AVISO! Tecla Caps Lock está ativada.</div>
      <input type="text" name="email" id="email" placeholder="NOME DE USUÁRIO" autocomplete="off" required autofocus>
      <input type="password" name="password" id="password" placeholder="DIGITE A SUA SENHA" autocomplete="off" required>
      <p><button type="submit">logar</button></p><br>
    </form>

  </div>


  <script>
    const input = document.getElementById("password");
    const text = document.getElementById("warning_caps");
    input.addEventListener("keyup", function(event) {

      if (event.getModifierState("CapsLock")) {
        text.style.display = "block";
      } else {
        text.style.display = "none"
      }
    });
  </script>
</body>

</html>