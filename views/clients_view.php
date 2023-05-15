<div class="breadcrumb">
    <h2>Clientes<i class="fas fa-angle-right fa-xs"></i>Visualizar</h2>

    <span>
        <a class="btn" href="<?php echo BASE_URL; ?>clients"><i class="fas fa-angle-double-left"></i> Voltar</a>
    </span>
</div>

<div class="content">

    <!-- Botões de Navegação (Navigation Buttons) -->
    <div class="table-line my-l">
        <a class="btn" href="<?php echo BASE_URL; ?>clients/edit/<?php echo $client_info['id']; ?>">Editar</a>
        <a class="btn mx-s mb-976-hide" href="#" id="btn_print" onclick="PrintDiv()">Imprimir</a>
    </div>

    <!-- Dados do Client (Client's Data) -->
    <div id="printarea" class="w-100">
        <h2 class="display_print txt-center">Informações do Cliente</h2>
        <div class="table-line py-1">
            <label class="mr-el px-s bold" for="phone">Nome do Cliente</label>
            <p><?php echo $client_info['client_name']; ?></p>
        </div>
        <div class="table-line py-1">
            <div class="table-33 my-s">
                <label class="mr-el px-s bold" for="phone">Celular</label>
                <p><?php echo $client_info['phone']; ?></p>
            </div>
            <div class="table-33 my-s">
                <label class="mr-el bold" for="cellphone">Celular 2</label>
                <p><?php echo $client_info['cellphone']; ?></p>
            </div>
            <div class="table-33 my-s">
                <label class="mr-el bold" for="whatsapp">Internacional</label>
                <p><?php echo $client_info['whatsapp']; ?></p>
            </div>
        </div>
        <div class="table-line py-1">
            <div class="table-33 my-s">
                <label class="mr-el px-s bold" for="cpf">CPF</label>
                <p>
                    <?php echo $client_info['cpf']; ?>
                </p>
            </div>
            <div class="table-33 my-s">
                <label class="mr-el bold" for="identity">RG</label>
                <p><?php echo $client_info['identity']; ?></p>
            </div>
        </div>
        <div class="table-line py-1">
            <div class="table-50 my-s">
                <label for="" class="mr-el px-s bold">Data de Nascimento</label>
                <p><?php echo date('d/m/Y', strtotime($client_info['birth_date'])); ?></p>
            </div>
            <div class="table-50 my-s">
                <label class="mr-el bold" for="">E-mail</label>
                <p><?php echo $client_info['email']; ?></p>
            </div>
        </div>
        <div class="table-line py-1">
            <div class="table-50 my-s">
                <label class="mr-el bold" for="">Limite Disponível</label>
                <p></p>
            </div>
        </div>
        <div class="table-line py-1">
            <label class="mr-el px-s bold" for="">Informações Adicionais</label>
            <p><?php echo $client_info['aditional_info']; ?></p>
        </div>

        <!-- Endereço (Address) -->
        <div class="rounded-m bg_light_gray p-m">
            <h2 class="my-el spt">Endereço</h2>
            <div class="table-line py-1">
                <label class="mr-el px-s bold" for="">Endereço</label>
                <p><?php echo $client_info['address'] . ", " . $client_info['address_number'] . ", " . $client_info['address_neighb'] . ", " . $client_info['address2']; ?></p>
            </div>
            <div class="table-line py-1">
                <label for="" class="mr-el px-s bold">Cidade/UF</label>
                <p><?php echo $client_info['address_city'] . " - " . $client_info['address_state']; ?></p>
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