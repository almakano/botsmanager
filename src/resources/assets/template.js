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

	},
	onAjax: function(e){

		e.preventDefault();
		var th		 = $(e.target);
		var url		 = (typeof th.attr('action') != 'undefined' ? th.attr('action') : th.attr('href'));
		var target	 = $('<div style="display: none"></div>').appendTo('body');
		var data	 = {'_ajax': Date.now(), '_token': $('meta[name="csrf-token"]').attr('content')};

		if(typeof th.attr('action') != 'undefined') th.find('[name]').each(function(){
			var i = $(this);
			if(i.attr('type') == 'checkbox' && !i.prop('checked')) return;
			data[i.attr('name')] = i.val();
		});

		target.load(url, data, function(){
			target.remove();
			app.onLoad();
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