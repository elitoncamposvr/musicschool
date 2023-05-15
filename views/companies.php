<!-- Breadcrumbs -->
<div class="breadcrumb">
    <h2>Configurações<i class="fas fa-angle-right fa-xs"></i>Dados da Empresa</h2>
    <span>
        <a class="btn" href="<?php echo BASE_URL; ?>settings/company"><i class="fas fa-angle-double-left"></i> Voltar</a>
    </span>
</div>

<div class="content">
    <!-- Botões (Buttons) -->
    <div class="menu_data">
        <p>
            <?php if ($edit_permission) : ?>
                <a class="btn" href="<?php echo BASE_URL; ?>companies/edit">Editar Dados</a>
            <?php endif; ?>
        </p>
        <p>
            <a href="#" class="btn mobile-hidden" onclick="PrintDiv()">Imprimir Dados</a>
        </p>
    </div>

    <!-- Dados da Empresa (Company Data) -->
    <div class="w-100 txt-up" id="printarea">
        <h2 class="display_print txt-center">Informações da Empresa</h2>
        <div class="fb-100 py-s">
            <label for="name" class="mr-el bold">Nome da Empresa</label>
            <p><?php echo $viewData['company_name']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="social_reason" class="mr-el bold">Razão Social</label>
            <p><?php echo $companies_info['social_reason']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="cnpj" class="mr-el bold">CNPJ</label>
            <p><?php echo $companies_info['cnpj']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="state_registration" class="mr-el bold">Inscrição Estadual</label>
            <p><?php echo $companies_info['state_registration']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="email" class="mr-el bold">Email</label>
            <p><?php echo $companies_info['email']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="site" class="mr-el bold">Website</label>
            <p><?php echo $companies_info['site']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="phone" class="mr-el bold">Telefone</label>
            <p><?php echo $companies_info['phone']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="address_zipcode" class="mr-el bold">CEP</label>
            <p><?php echo $companies_info['address_zipcode']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="address" class="mr-el bold">Endereço</label>
            <p><?php echo $companies_info['address']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="address2" class="mr-el bold">Complemento</label>
            <p><?php echo $companies_info['address2']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="address_number" class="mr-el bold">Número</label>
            <p><?php echo $companies_info['address_number']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="address_neighb" class="mr-el bold">Bairro</label>
            <p><?php echo $companies_info['address_neighb']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="address_city" class="mr-el bold">Cidade</label>
            <p><?php echo $companies_info['address_city']; ?></p>
        </div>
        <div class="fb-100 py-s">
            <label for="address_state" class="mr-el bold">Estado</label>
            <p><?php echo $companies_info['address_state']; ?></p>
        </div>
    </div>

</div>

<!-- Script de Impressão (Print Script) -->
<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('printarea');
        var popupWin = window.open('', '_blank');
        popupWin.document.open();
        popupWin.document.write('<html><head><title>Informações da Empresa</title><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/main.css" /><style>body{display:block;}.display_print{display:block;}</style></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>