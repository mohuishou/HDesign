$(document).ready(function() {
// Global variables
thumbNumber = 0;
thumbTimer = 0;
archiveTitle = '';
mobileSubNavActive = false;
zoomedImageWidth = 0;
zoomedImageHeight = 0;
zoomedImage = 0;
// Mouse events
$(document).keydown(function(e) {
// alert(e.keyCode)
if (e.keyCode == 39) {
scrollArchive();
} 
});
// Set-up
$(window).resize(function() {
calcReplacementArchive();
toggleResponsiveItemsArchive();
});
calcReplacementArchive();
toggleResponsiveItemsArchive();
$('a#showcase-archive-arrow').stop()
.velocity({right: '0'}, 500);
// Mobile set-up
if (touchScreen) {
$('#archive-overlay-container').swipe({swipeLeft:function(event, direction, distance, duration, fingerCount) {
nextZoomedImage();
}, threshold: 50, excludedElements: '.noSwipe'
});
$(window).swipe({swipeRight:function(event, direction, distance, duration, fingerCount) {
prevZoomedImage();
}, threshold: 50, excludedElements: '.noSwipe'
});
}
});

function calcReplacementArchive() {
if (! Modernizr.csscalc) {
$('#archive-container, #projects-list-container').css({height: '100%'}).css({height: '-=83px'});
}
}

function toggleResponsiveItemsArchive() {
if ($(window).width() < 960) {
//$('a#showcase-archive-arrow').css({right: '-62px'});
$('#sub-nav a').css({display: 'none', width: '100%', backgroundColor: '#FFF', marginLeft: '0', marginRight: '0', marginTop: '0', paddingBottom: '15px'});
$('a#sub-nav-mobile').css({display: 'block', marginTop: '15px'});
mobileSubNavActive = false;
} else {
//$('a#showcase-archive-arrow').css({right: '0'});
$('#sub-nav a').css({display: '', width: '', backgroundColor: '', marginLeft: '', marginRight: '', marginTop: '', paddingBottom: ''});
$('a#sub-nav-mobile').hide();
}
setArchiveSizes();
hideProjectsList();
if ($('#archive-overlay-container').is(':visible') == true) {
resizeZoomedImage();
}
}

function setArchiveSizes() {
var i = $('#archive-wrapper').height();
var ii = ($('#archive-wrapper').height() / 2);
$('.archive-title').css({width: i + 'px', height: i + 'px'});
$('.archive-thumb-1').css({width: Math.floor(ii * 3) + 'px', height: i + 'px'});
$('.archive-thumb-2').css({width: i + 'px', height: ii + 'px', marginBottom: ii + 'px'});
$('.archive-thumb-3').css({width: i + 'px', height: ii + 'px', marginTop: ii + 'px'});
$('.archive-thumb-4').css({width: ii + 'px', height: ii + 'px', marginBottom: ii + 'px'});
$('.archive-thumb-5').css({width: ii + 'px', height: ii + 'px', marginTop: ii + 'px'});
$('.archive-thumb-6').css({width: i + 'px', height: i + 'px'});
var j = 0;
$('.archive-item').each(function(i) {
j = j + $(this).width() + 2;
});
$('#archive-wrapper').css({width: j + 'px'});
$('a#archive-projects-link').css({height: Math.floor(i / 3) + 'px'});
$('a#showcase-archive-arrow').stop()
.css({top: Math.floor((i / 3) + ii + 83) + 'px'});
}

function loadProjectsList() {
var i = Math.floor($(window).width() - 320);
$('#archive-container').stop()
.velocity({width: i + 'px'}, 500);
$('a#archive-projects-link').removeClass('animate-fade-in-1')
.hide();
$('#projects-list-container').stop()
.velocity({marginLeft: '0'}, 500);
calcReplacementArchive();
}

function hideProjectsList() {
if ($('a#archive-projects-link').is(':visible') == false) {
$('#archive-container').css({width: '100%'});
$('a#archive-projects-link').addClass('animate-fade-in-1')
.show();
$('#projects-list-container').css({marginLeft: '-320px'});
}
}

function scrollToProject(i) {
hideProjectsList();
var j = $('#archive-title-' + i).offset().left;
j = Math.floor($('#archive-container').scrollLeft() + j);
$('#archive-container').stop()
.animate({scrollLeft: j}, 1000);
}

function loadArchiveThumb(i) {
var j = $('a#archive-thumb-' + i + ' img').attr('alt');
$('a#archive-thumb-' + i + ' img').attr({src: j})
.imagesLoaded(function() {
if (thumbNumber == i) {
$(this).unbind('load');
if ($(this).height() < $('a#archive-thumb-' + i).height()) {
$('a#archive-thumb-' + i).css({backgroundImage: 'url(' + j + ')', backgroundSize: 'auto 100%'});
} else {
$('a#archive-thumb-' + i).css({backgroundImage: 'url(' + j + ')', backgroundSize: '100% auto'});
}
$(this).hide();
$('a#archive-thumb-' + i).addClass('animate-fade-in-1')
.css({opacity: '1'});
var k = i + 1;
if ($('a#archive-thumb-' + k).length == 1) {
thumbTimer = setTimeout(function() {
loadArchiveThumb(k);
}, 100);
}
}
});
thumbNumber = i;
}

function scrollArchive() {
var i = $(window).width();
var j = $('#archive-container').scrollLeft();
i = i + j;
$('#archive-container').stop()
.animate({scrollLeft: i}, 1000);
}

function showMobileSubNavArchive() {
if (mobileSubNavActive) {
$('#sub-nav a').hide();
$('a#sub-nav-mobile').show();
mobileSubNavActive = false;
} else {
$('#sub-nav a').css({display: 'block'});
$('a#sub-nav-' + archiveTitle).hide();
mobileSubNavActive = true;
}
}

function loadZoomedImage(i) {
if ($('#archive-overlay-container').is(':visible') == false) {
$('#archive-overlay-container').show()
.addClass('animate-fade-in-1');
}
var j = $('a#archive-thumb-' + i + ' img').attr('alt');
j = j.replace('h_', '');
j = j.replace('q_', '');
$('#archive-overlay-container img#archive-overlay').hide()
.removeClass('animate-fade-in-1')
.attr({src: j})
.imagesLoaded(function() {
$(this).unbind('load');
setTimeout(function() {
if (zoomedImage == i) {
$('#archive-overlay-container img#archive-overlay').show()
.addClass('animate-fade-in-1');
zoomedImageWidth = $('#archive-overlay-container img#archive-overlay').width();
zoomedImageHeight = $('#archive-overlay-container img#archive-overlay').height();
resizeZoomedImage();
}
}, 100);
});
zoomedImage = i;
}

function closeZoomedImage() {
$('#archive-overlay-container, #archive-overlay-container img#archive-overlay').hide()
.removeClass('animate-fade-in-1');
}

function resizeZoomedImage() {
if (zoomedImageWidth < $('#archive-overlay-container').width() && zoomedImageHeight < $('#archive-overlay-container').height()) {
$('#archive-overlay-container img#archive-overlay').css({top: '50%', left: '50%', marginLeft: Math.floor(0 - (zoomedImageWidth / 2)) + 'px', marginTop: Math.floor(0 - (zoomedImageHeight / 2)) + 'px', width: zoomedImageWidth + 'px', height: zoomedImageHeight + 'px'});
} else {
$('#archive-overlay-container img#archive-overlay').css({top: '', left: '', marginLeft: '', marginTop: '', width: '', height: ''});
var k = $('#archive-overlay-container').height() / zoomedImageHeight * 100;
var l = zoomedImageWidth / 100 * k; 
if (l > $('#archive-overlay-container').width()) {
$('#archive-overlay-container img#archive-overlay').css({width: $('#archive-overlay-container').width() + 'px', height: ''});
var m = $('#archive-overlay-container img#archive-overlay').width() / zoomedImageWidth * 100;
m = zoomedImageHeight / 100 * m; 
$('#archive-overlay-container img#archive-overlay').css({top: Math.floor(($('#archive-overlay-container').height() - m) / 2) + 'px', left: '0'});
} else {
$('#archive-overlay-container img#archive-overlay').css({height: $('#archive-overlay-container').height() + 'px', width: ''});
m = $('#archive-overlay-container img#archive-overlay').height() / zoomedImageHeight * 100;
m = zoomedImageWidth / 100 * m; 
$('#archive-overlay-container img#archive-overlay').css({left: Math.floor(($('#archive-overlay-container').width() - m) / 2) + 'px', top: '0'});
}
}
}

function nextZoomedImage() {
var i = zoomedImage + 1;
if ($('a#archive-thumb-' + i).length == 1) {
loadZoomedImage(i);
}
}

function prevZoomedImage() {
var i = zoomedImage - 1;
if ($('a#archive-thumb-' + i).length == 1) {
loadZoomedImage(i);
}
}