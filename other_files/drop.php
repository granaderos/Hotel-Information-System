/*
//--------------dropdown---------
$('#sites_a').hover(function () {
clearTimeout($.data(this, 'timer'));
$('#sites_ul', this).stop(true, true).slideDown(200);
}, function () {
$.data(this, 'timer', setTimeout($.proxy(function() {
$('sites_ul', this).stop(true, true).slideUp(200);
}, this), 200));
});
*/