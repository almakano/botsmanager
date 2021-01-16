var app = {

	onLoad: function(e){

		if(typeof $.fn.select2 != 'undefined') $('select').not('.initialized').each(function(){
			$(this).addClass('initialized').select2({
				dropdownAutoWidth : true,
				width: 'auto',
				ajax: {
					data: function (params) {
						return { q: params.term };
					}
				}
			});
		});

		app.onAjax();
	},
	onAjax: function(e){

		e.preventDefault();
		var th		 = $(this);
		var url		 = th.attr('action') || th.attr('href');
		var target	 = $('<div style="display: none"></div>').appendTo('body');
		var data	 = {};

		if(th.attr('action')) th.find('[name]').each(function(){
			var i = $(this);
			if(i.attr('type') == 'checkbox' && !i.prop('checked')) return;
			data[i.attr('name')] = i.attr('value');
		});

		target.load(url, data, function(){
			target.remove();
		});
	}
};

$(function(){

	var d = $(document);
	var w = $(window);

	d.ajaxComplete(app.onLoad);
	d.on('submit', app.onAjax);
	d.on('click', '[data-ajax]', app.onAjax);
	w.on('scroll', app.onLoad);

	app.onLoad();
});