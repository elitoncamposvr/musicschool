$(document).ready(function () {
	$(".change_type").change(function () {
		$(this).find("option:selected")
			.each(function () {
				var optionValue = $(this).attr("id");
				if (optionValue) {
					$(".hide").not("." + optionValue).hide();
					$("." + optionValue).show();
				} else {
					$(".hide").hide();
				}
			});
	}).change();
});
