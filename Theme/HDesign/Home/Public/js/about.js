$(document).ready(function() {
// Global variables
aboutPage = 'leadership';
leadershipImageWidth = 0;
leadershipImageHeight = 0;
foundationImageWidth = 0;
foundationImageHeight = 0;
// Mouse events
// Set-up
$(window).resize(function() {
calcReplacementAbout();
toggleResponsiveItemsAbout();
});
calcReplacementAbout();
toggleResponsiveItemsAbout();
$('#sub-nav').addClass('animate-margin-top-05')
.css({marginTop: '0'});
swapAboutPage(aboutPage);
$('#about-leadership-container .about-image-container img').imagesLoaded(function() {
$(this).unbind('load')
.show()
.addClass('animate-fade-in-1');
if ($('#about-leadership-container').is(':visible') == true) {
resizeLeadershipImage();
}
});
$('#about-foundation-container .about-image-container img').imagesLoaded(function() {
$(this).unbind('load')
.show()
.addClass('animate-fade-in-1');
if ($('#about-foundation-container').is(':visible') == true) {
resizeFoundationImage();
}
});
// Mobile set-up
if (touchScreen) {

}
});

function calcReplacementAbout() {
if (! Modernizr.csscalc) {
$('.about-container').css({height: '100%'}).css({height: '-=83px'});
}
}

function toggleResponsiveItemsAbout() {
if ($(window).width() < 960) {
$('#sub-nav a').css({display: 'none', width: '100%', backgroundColor: '#FFF', marginLeft: '0', marginRight: '0', marginTop: '0', paddingBottom: '15px'});
$('a#sub-nav-mobile').css({display: 'block', marginTop: '15px'});
mobileSubNavActive = false;
$('.about-text-container').css({width: '100%'});
$('.about-text-container p, .about-text-container h3').css({padding: '25px'});
$('.about-text-container p').css({paddingTop: '0'});
$('.about-image-container').hide();
$('#about-foundation-container .about-text-container').css({left: '0'});
$('img.about-image-mobile').show();
} else {
$('#sub-nav a').css({display: '', width: '', backgroundColor: '', marginLeft: '', marginRight: '', marginTop: '', paddingBottom: ''});
$('a#sub-nav-mobile').hide();
$('.about-text-container').css({width: ''});
$('.about-text-container p, .about-text-container h3').css({padding: ''});
$('.about-text-container p').css({paddingTop: ''});
$('.about-image-container').show();
$('#about-foundation-container .about-text-container').css({left: ''});
$('img.about-image-mobile').hide();
}
if ($('#about-leadership-container .about-image-container img').is(':visible') == true) {
resizeLeadershipImage();
}
if ($('#about-foundation-container .about-image-container img').is(':visible') == true) {
resizeFoundationImage();
}
}

function swapAboutPage(i) {
if (i == 'leadership' && $('#about-leadership-container').hasClass('animate-fade-in-1') == false && $('#about-foundation-container').hasClass('animate-fade-in-1') == false) {
$('#about-leadership-container').removeClass('animate-fade-out-1')
.show()
.addClass('animate-fade-in-1');
calcReplacementAbout();
toggleResponsiveItemsAbout();
$('#about-foundation-container').removeClass('animate-fade-in-1')
.addClass('animate-fade-out-1');
setTimeout(function() {
if (aboutPage == 'leadership') {
$('#about-leadership-container').removeClass('animate-fade-in-1');
$('#about-foundation-container').hide();
}
}, 1000);
$('a#sub-nav-leadership').css({color: '#33F'});
$('a#sub-nav-foundation').css({color: ''});
$('a#sub-nav-mobile span').empty()
.append('LEADERSHIP');
aboutPage = 'leadership';
} else if (i == 'foundation' && $('#about-leadership-container').hasClass('animate-fade-in-1') == false && $('#about-foundation-container').hasClass('animate-fade-in-1') == false) {
$('#about-foundation-container').removeClass('animate-fade-out-1')
.show()
.addClass('animate-fade-in-1');
calcReplacementAbout();
toggleResponsiveItemsAbout();
$('#about-leadership-container').removeClass('animate-fade-in-1')
.addClass('animate-fade-out-1');
setTimeout(function() {
if (aboutPage == 'foundation') {
$('#about-foundation-container').removeClass('animate-fade-in-1');
$('#about-leadership-container').hide();
}
}, 1000);
$('a#sub-nav-foundation').css({color: '#33F'});
$('a#sub-nav-leadership').css({color: ''});
$('a#sub-nav-mobile span').empty()
.append('FOUNDATION');
aboutPage = 'foundation';
}
}

function resizeLeadershipImage() {
if (! leadershipImageWidth) {
leadershipImageWidth = $('#about-leadership-container .about-image-container img').width();
leadershipImageHeight = $('#about-leadership-container .about-image-container img').height();
}
var i = leadershipImageWidth;
var j = leadershipImageHeight;
if ($('#about-leadership-container .about-image-container').height() > $('#about-leadership-container .about-image-container img').height() || $('#about-leadership-container .about-image-container').width() < $('#about-leadership-container .about-image-container img').width()) {
$('#about-leadership-container .about-image-container img').height($('#about-leadership-container .about-image-container').height());
var k = $('#about-leadership-container .about-image-container img').height() / j * 100;
k = i / 100 * k;
$('#about-leadership-container .about-image-container img').width(k);
}
if ($('#about-leadership-container .about-image-container').width() > $('#about-leadership-container .about-image-container img').width() || $('#about-leadership-container .about-image-container').height() < $('#about-leadership-container .about-image-container img').height()) {
$('#about-leadership-container .about-image-container img').width($('#about-leadership-container .about-image-container').width());
k = $('#about-leadership-container .about-image-container img').width() / i * 100;
k = j / 100 * k;
$('#about-leadership-container .about-image-container img').height(k);
}
var l = $('#about-leadership-container .about-image-container').width() - $('#about-leadership-container .about-image-container img').width();
l = Math.round(l / 2);
k = $('#about-leadership-container .about-image-container').height() - $('#about-leadership-container .about-image-container img').height();
k = Math.round(k / 2);
$('#about-leadership-container .about-image-container img').css({top: k + 'px', left: l + 'px'});
}

function resizeFoundationImage() {
if (! foundationImageWidth) {
foundationImageWidth = $('#about-foundation-container .about-image-container img').width();
foundationImageHeight = $('#about-foundation-container .about-image-container img').height();
}
var i = foundationImageWidth;
var j = foundationImageHeight;
if ($('#about-foundation-container .about-image-container').height() > $('#about-foundation-container .about-image-container img').height() || $('#about-foundation-container .about-image-container').width() < $('#about-foundation-container .about-image-container img').width()) {
$('#about-foundation-container .about-image-container img').height($('#about-foundation-container .about-image-container').height());
var k = $('#about-foundation-container .about-image-container img').height() / j * 100;
k = i / 100 * k;
$('#about-foundation-container .about-image-container img').width(k);
}
if ($('#about-foundation-container .about-image-container').width() > $('#about-foundation-container .about-image-container img').width() || $('#about-foundation-container .about-image-container').height() < $('#about-foundation-container .about-image-container img').height()) {
$('#about-foundation-container .about-image-container img').width($('#about-foundation-container .about-image-container').width());
k = $('#about-foundation-container .about-image-container img').width() / i * 100;
k = j / 100 * k;
$('#about-foundation-container .about-image-container img').height(k);
}
var l = $('#about-foundation-container .about-image-container').width() - $('#about-foundation-container .about-image-container img').width();
l = Math.round(l / 2);
k = $('#about-foundation-container .about-image-container').height() - $('#about-foundation-container .about-image-container img').height();
k = Math.round(k / 2);
$('#about-foundation-container .about-image-container img').css({top: k + 'px', left: l + 'px'});
}

function showMobileSubNavAbout() {
if (mobileSubNavActive) {
$('#sub-nav a').hide();
$('a#sub-nav-mobile').show();
mobileSubNavActive = false;
} else {
$('#sub-nav a').css({display: 'block'});
$('a#sub-nav-' + aboutPage).hide();
mobileSubNavActive = true;
}
}