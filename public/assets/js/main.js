(function($) {

	"use strict";


	$(".js-select2").select2({
			closeOnSelect : false,
			placeholder : "",
			allowHtml: true,
			allowClear: true,
			tags: true // ÑÐ¾Ð·Ð´Ð°ÐµÑ‚ Ð½Ð¾Ð²Ñ‹Ðµ Ð¾Ð¿Ñ†Ð¸Ð¸ Ð½Ð° Ð»ÐµÑ‚Ñƒ
		});

	$('.icons_select2').select2({
		width: "100%",
		templateSelection: iformat,
		templateResult: iformat,
		allowHtml: true,
		placeholder: "",
		dropdownParent: $( '.select-icon' ),//Ð¾Ð±Ð°Ð²Ð¸Ð»Ð¸ ÐºÐ»Ð°ÑÑ
		allowClear: true,
		multiple: false
	});


	function iformat(icon, badge,) {
		var originalOption = icon.element;
		var originalOptionBadge = $(originalOption).data('badge');

		return $('<span><i class="fa ' + $(originalOption).data('icon') + '"></i> ' + icon.text + '<span class="badge">' + originalOptionBadge + '</span></span>');
	}

})(jQuery);
