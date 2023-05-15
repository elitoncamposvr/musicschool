<div class="breadcrumb">
    <h2>Fornecedores<i class="fas fa-angle-right fa-xs"></i>Visualizar</h2>

    <span>
        <a class="btn" href="<?php echo BASE_URL; ?>provider"><i class="fas fa-angle-double-left"></i> Voltar</a>
    </span>
</div>

<div class="content">

    <!-- Botões de Navegação (Navigation Buttons) -->
    <div class="flex w-100 my-l">
        <a class="btn" href="<?php echo BASE_URL; ?>provider/edit/<?php echo $provider_info['id']; ?>">Editar</a>
        <a class="btn mx-s mb-976-hide" href="#" id="btn_print" onclick="PrintDiv()">Imprimir</a>
    </div>

    <!-- Dados do Client (Client's Data) -->
    <div id="printarea" class="w-100">
        <h2 class="display_print txt-center">Informações do Fornecedor</h2>
        <div class="table-line">
            <div class="table-75 my-s">
                <label class="mr-el px-s bold" for="phone">Nome do Fornecedor</label>
                <p><?php echo $provider_info['name_provider']; ?></p>
            </div>
            <div class="table-25 my-s">
                <label class="mr-el px-s bold" for="phone">Contato</label>
                <p><?php echo $provider_info['contact_name']; ?></p>
            </div>
        </div>
        <div class="table-line">
            <div class="table-33 my-s">
                <label class="mr-el px-s bold" for="phone">Telefone</label>
                <p><?php echo $provider_info['phone']; ?></p>
            </div>
            <div class="table-33 my-s">
                <label class="mr-el bold" for="cellphone">Celular</label>
                <p><?php echo $provider_info['cellphone']; ?></p>
            </div>
            <div class="table-33 my-s">
                <label class="mr-el bold" for="whatsapp">WhatsApp</label>
                <p><?php echo $provider_info['whatsapp']; ?></p>
            </div>
        </div>
        <div class="table-line">
            <div class="table-35 my-s">
                <label class="mr-el px-s bold" for="cpf">CPF/CNPJ</label>
                <p>
                    <?php echo $provider_info['cpf']; ?>
                    <?php echo $provider_info['cnpj']; ?>
                </p>
            </div>
            <div class="table-35 my-s">
                <label class="mr-el bold" for="identity">RG</label>
                <p><?php echo $provider_info['identity']; ?></p>
            </div>
            <div class="table-30 my-s">
                <label class="mr-el bold" for="state_registration">Inscrição Estadual</label>
                <p><?php echo $provider_info['state_registration']; ?></p>
            </div>
        </div>
        <div class="table-line">
            <div class="table-35 my-s">
                <label for="" class="mr-el px-s bold">Data de Nascimento</label>
                <p><?php if ($provider_info['birth_date'] != '') {
                        echo date('d/m/Y', strtotime($provider_info['birth_date']));
                    } ?></p>
            </div>
            <div class="table-35 my-s">
                <label class="mr-el bold" for="">E-mail</label>
                <p><?php echo $provider_info['email']; ?></p>
            </div>
            <div class="table-30 my-s">
                <label class="mr-el bold" for="">Site</label>
                <p><?php echo $provider_info['site']; ?></p>
            </div>
        </div>
        <div class="table-line">
            <label class="mr-el px-s bold" for="">Informações Adicionais</label>
            <p><?php echo $provider_info['aditional_info']; ?></p>
        </div>

        <!-- Endereço (Address) -->
        <div class="rounded-m bg_light_gray p-m">
            <h2 class="my-el spt">Endereço</h2>
            <div class="table-line">
                <label class="mr-el px-s bold" for="">Endereço</label>
                <p><?php echo $provider_info['address'] . ", " . $provider_info['address_number'] . ", " . $provider_info['address_neighb'] . ", " . $provider_info['address2']; ?></p>
            </div>
            <div class="table-line">
                <label for="" class="mr-el px-s bold">Cidade/UF</label>
                <p><?php echo $provider_info['address_city'] . " - " . $provider_info['address_state']; ?></p>
            </div>
        </div>
    </div>
</div>

<!--Script Impressão (Print)  -->
<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('printarea');
        var popupWin = window.open('', '_blank');
        popupWin.document.open();
        popupWin.document.write('<html><head><title>Informações do Cliente</title><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>assets/css/main.css" /><style>body{display:block;}.display_print{display:block;}</style></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>