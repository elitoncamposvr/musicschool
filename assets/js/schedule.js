function showBtnService(elemento) {
    elemento.style.display = "none";
    document.getElementById("schedule-service--form").style.display = "block";
}

function showBtnDiscount(elemento) {
    elemento.style.display = "none";
    document.getElementById("schedule-service--form-discount").style.display = "block";
}

function showBtnAditionalInfo(elemento) {
    elemento.style.display = "none";
    document.getElementById("schedule--form-aditional-info").style.display = "block";
}

function infoShow() {
    let item = document.getElementById('item-info')
    if (item.style.display === 'flex') {
        item.style.display = 'none'
    } else {
        item.style.display = 'flex'
    }
}

function historyShow() {
    let item = document.getElementById('item-toggle')
    if (item.style.display === 'flex') {
        item.style.display = 'none'
    } else {
        item.style.display = 'flex'
    }
}



//DISCOUNT

let dataSale = document.querySelector("[data-services]");
let dscValue = document.querySelector("[data-discount]")
let valueSale = Number(dataSale.dataset.services);
let discountValue = Number(dscValue.dataset.discount);
let total = valueSale - discountValue

document.querySelector(".total-area").innerHTML = total.toFixed(2).toString().replace('.', ',');

let areaPayment = document.querySelector("#schedule-service--form-payment");

//SERVICE ADD

function addTime() {
    let inputService = document.querySelector("#service_id").options.selectedIndex;
    let service = document.querySelector("#service_id");
    let timeData = service.options[inputService];
    let newTime = timeData.dataset['time'];

    document.querySelector("#time_service").value = newTime;
    console.log(newTime);

    let saleService = timeData.dataset['sale'];
    document.querySelector("#sale_value_standard").value = saleService;
    console.log(saleService);
    saleTotal();
    totalCost();
}

function saleTotal() {
    let inputSale = document.querySelector("#sale_value_standard").value;
    let inputPassengers = document.querySelector("#passengers").value;
    let total = inputSale * inputPassengers;
    document.querySelector("#total_sale").value = total;

    console.log(inputSale + " " + inputPassengers + " " + total);

    totalCost();
}

function totalCost(){
    let inputService = document.querySelector("#service_id").options.selectedIndex;
    let service = document.querySelector("#service_id");
    let timeData = service.options[inputService];

    let totalCost = timeData.dataset['cost'];
    let inputPassengers = document.querySelector("#passengers").value;
    let total = totalCost * inputPassengers;
    document.querySelector("#total_cost").value = total;

}