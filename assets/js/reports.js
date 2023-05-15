function openPopupSales(obj){
	var data = $(obj).serialize();

	var url = BASE_URL+'report/sales_pdf?'+data;
	window.open(url, "report", "width=800, height=600");

	return false;
}

function openPopupInventory(obj){
	var data = $(obj).serialize();

	var url = BASE_URL+'report/inventory_pdf?'+data;
	window.open(url, "report", "width=800, height=600");

	return false;
}