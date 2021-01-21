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
		var spinner	 = $('<span class="spinner"></span>').prependTo(e.target);

		if(typeof th.attr('action') != 'undefined') th.find('[name]').each(function(){
			var i = $(this);
			if(i.attr('type') == 'checkbox' && !i.prop('checked')) return;
			data[i.attr('name')] = i.val();
		});

		target.load(url, data, function(){
			app.onLoad();
			target.add(spinner).remove();
		});

	},
	alert: function(message) {
		let alert = $('<div class="alert alert-'+(message.type?message.type:'info')+'" data-toggle="alert" data-dismiss="alert">'+message.text+'</div>');
		$('.alerts').append(alert);
		if(message.timeout) setTimeout(function(){
			alert.slideUp(300, function(){ alert.remove(); });
		}, message.timeout);
	},
	checkAll: function(e) {

		var th = $(this);
		var val = th.is(':checked');
		var checks = $('[data-check-id]');
		var checks_on = checks.filter(':checked');
		var ids = {};

		if(typeof th.attr('data-checkall') != 'undefined'){

			$('[data-check-id]').prop('checked', val);

		} else {

			$('[data-checkall]').prop('checked', val && checks.length == checks_on.length);

		}

		ckecks_on.each(function(){
			ids[this] = 
		});

		$('.multiple-actions').collapse(checks_on.length?'show':'hide');
		$('.multiple-actions').find('input[name="id"]').val()

	},
	refreshList: function(e) {
		$('#ajax-data').load(' #ajax-data > *');
	}
};

$(function(){

	var d = $(document);
	var w = $(window);

	d.ajaxComplete(app.onLoad);
	d.on('submit', '[data-ajax]', app.onAjax);
	d.on('click', 'a[data-ajax], button[data-ajax]', app.onAjax);
	w.on('scroll', app.onLoad);
	d.on('change', '[data-checkall], [data-check-id]', app.checkAll);

	app.onLoad();
});