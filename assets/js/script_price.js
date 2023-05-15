$(function(){

	$('input[id=price]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=min_price]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=purchase_price]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=receipt_amount]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=standard_value]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=advance_amount]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=limit_credit]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=wage]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=bill_amount]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=amount_paid]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
	$('input[id=profit]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
  $('input[id=sale_value]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});
  $('input[id=discount]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"});

});

  function profitCalcSale(){
      let purchase_price = document.getElementById('purchase_price').value
      let sale_price = document.getElementById('price').value
      let profit = document.getElementById('profit')
      let value1 = parseFloat(purchase_price.replace(',', '.'))
      let value2 = parseFloat(sale_price.replace(',', '.'))
      let percentage = value2 - value1
      let res = percentage / value1 * 100
      if (profit.value != ''){
        profit.value = res.toFixed(2).replace('.', ',')
      }
    }

    function valueCalcSale() {
      let purchase_price = document.getElementById('purchase_price').value
      let profit = document.getElementById('profit').value
      let value1 = parseFloat(purchase_price.replace(',', '.'))
      let value2 = parseFloat(profit)
      let percentage = value1 * value2 / 100
      let res = value1 + percentage
      document.getElementById('price').value = res.toFixed(2).toString().replace('.', ',')
    }

    function profitCalc(){
      let purchase_price = document.getElementById('purchase_price').value
      let sale_price = document.getElementById('price').value
      let value1 = parseFloat(purchase_price.replace(',', '.'))
      let value2 = parseFloat(sale_price.replace(',', '.'))
      let percentage = value2 - value1
      let res = percentage / value1 * 100
      document.getElementById('profit').value = res.toFixed(2).replace('.', ',')
	  
    }