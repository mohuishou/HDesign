$(document).ready(function () {
	$("body").css("display", "none");
	$("body").fadeIn('fast');
	$("a.transition").click(function(event){
		event.preventDefault();
		linkLocation = this.href;
		if ($(this).attr('href') != '#') {
			$("body").fadeOut('fast', redirectPage);
		}   
	});
	$("#left_menu a").click(function(event){
		event.preventDefault();
		linkLocation = this.href;
		if ($(this).attr('href') != '#') {
			$("body").fadeOut('fast', redirectPage);
		}   
	});

	setContentCenter();
});

$(window).resize(function(){
	setContentCenter();
});

function setContentCenter () {
	if ($(window).width()>960) {
		wml = ($(window).width() - 660 - 270) / 2 + 270;
	} else {
		wml = 290;
	}
	$('.content').css('margin-left',wml);
}

function redirectPage() {
	window.location = linkLocation;
}