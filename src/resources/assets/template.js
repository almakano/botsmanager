var app = {
	onLoad: function(){

	}
};

$(function(){

	var d = $(document);
	var w = $(window);

	d.ajaxComplete(app.onLoad);
	w.on('scroll', app.onLoad());

	app.onLoad();
});