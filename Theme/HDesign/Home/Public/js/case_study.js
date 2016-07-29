$(document).ready(function() {
// Global variables
caseStudyImageCount = 0;
caseStudyImageNumber = 1;
caseStudyCover = true;
caseStudyAnimated = false;
isScrolling = false;
// Mouse events
$(document).keydown(function(e) {
if (e.keyCode == 40 || e.keyCode == 32) {
goToNextImage();
} else if (e.keyCode == 38) {
goToPrevImage();
} 
});
$(document).on('mousewheel', function(event) {
if (event.originalEvent.wheelDelta >= 0 && isScrolling == false) {
goToPrevImage();
isScrolling = true;
} else if (isScrolling == false) {
goToNextImage();
isScrolling = true;
}
clearTimeout($.data(this, 'timer'));
$.data(this, 'timer', setTimeout(function() {
isScrolling = false;
}, 250));
});
// Set-up
$(window).resize(function() {
calcReplacementCaseStudy();
toggleResponsiveItemsCaseStudy();
});
calcReplacementCaseStudy();
toggleResponsiveItemsCaseStudy();
$('#sub-nav').stop()
.velocity({marginTop: '0'}, 500);
$('a#case-study-nav-item-1').css({backgroundColor: '#CCC'});
// Mobile set-up
if (touchScreen) {
$('#case-studies-container').swipe({swipeDown:function(event, direction, distance, duration, fingerCount) {
goToPrevImage()
}, threshold: 50, excludedElements: '.noSwipe'
});
$(window).swipe({swipeUp:function(event, direction, distance, duration, fingerCount) {
goToNextImage();
}, threshold: 50, excludedElements: '.noSwipe'
});
}
});

function calcReplacementCaseStudy() {
if (! Modernizr.csscalc) {
$('#case-study-title-container, .case-study-image-container, #case-study-nav').css({height: '100%'}).css({height: '-=83px'});
}
}

function toggleResponsiveItemsCaseStudy() {
if ($(window).width() < 960) {
$('#case-study-nav, a#sub-nav-case-showcase').hide();
$('a#case-study-down-arrow, a#case-study-up-arrow').css({height: '20px'});
$('a#case-study-down-arrow img, a#case-study-up-arrow img').css({height: '8px', marginTop: '6px'});
} else {
$('#case-study-nav, a#sub-nav-case-showcase').show();
$('a#case-study-down-arrow, a#case-study-up-arrow').css({height: ''});
$('a#case-study-down-arrow img, a#case-study-up-arrow img').css({height: '', marginTop: ''});
}
$('.case-study-image-container').each(function(i) {
var j = i + 1;
if ($(this).is(':visible') == true) {
if ($('.case-study-text-container', this).is(':visible') == true) {
resizeCaseStudyImageLeft(j);
} else {
resizeCaseStudyImage(j);
}
}
});
}

function loadCaseStudyImage(i) {
var j = $('#case-study-image-container-' + i + ' img').attr('alt');
$('#case-study-image-container-' + i + ' img').attr({src: j})
.imagesLoaded(function() {
$(this).unbind('load')
.addClass('animate-fade-in-1')
.show();
if (window['caseStudyImage' + i + 'Text'] != '') {
resizeCaseStudyImageLeft(i);
} else {
resizeCaseStudyImage(i);
}
if (i == 1) {
setTimeout(function() {
$('#case-study-title-container').stop()
.velocity({top: '100%'}, 500);
caseStudyCover = false;
}, 2000);
}
if (i < caseStudyImageCount) {
var k = i + 1;
loadCaseStudyImage(k);
}
});
}

function goToCaseStudy(i) {
caseStudyAnimated = true;
if (i != 1 && $('a#case-study-up-arrow').is(':visible') == false) {
$('a#case-study-up-arrow').show()
.addClass('animate-fade-in-1');
} else if ($('a#case-study-up-arrow').is(':visible') == true && i == 1) {
$('a#case-study-up-arrow').hide()
.removeClass('animate-fade-in-1');
}
if (i != caseStudyImageCount && $('a#case-study-down-arrow').is(':visible') == false) {
$('a#case-study-down-arrow').show()
.addClass('animate-fade-in-1');
} else if ($('a#case-study-down-arrow').is(':visible') == true && i == caseStudyImageCount) {
$('a#case-study-down-arrow').hide()
.removeClass('animate-fade-in-1');
}
var j = Math.floor(0 - ((i - 1) * 100));
$('#case-studies-container').stop()
.velocity({top: j + '%'}, 500, function() {
caseStudyAnimated = false;
});
$('#case-study-nav-wrapper a').css({backgroundColor: ''});
$('a#case-study-nav-item-' + i).css({backgroundColor: '#CCC'});
caseStudyImageNumber = i;
}

function goToPrevImage() {
if (caseStudyImageNumber != 1 && ! caseStudyCover && caseStudyAnimated == false) {
var i = caseStudyImageNumber - 1;
goToCaseStudy(i);
}
}

function goToNextImage() {
if (caseStudyImageNumber != caseStudyImageCount && ! caseStudyCover  && caseStudyAnimated == false) {
var i = caseStudyImageNumber + 1;
goToCaseStudy(i);
}
}

function resizeCaseStudyImage(i) {
if ($(window).width() < 960) {
var ii = 40;
} else {
ii = 80;
}
var fileWidth = window['caseStudyImage' + i + 'Width'];
var fileHeight = window['caseStudyImage' + i + 'Height'];
if (fileWidth < Math.floor($('#case-study-image-container-' + i).width() - ii) && fileHeight < Math.floor($('#case-study-image-container-' + i).height() - ii)) {
$('#case-study-image-container-' + i + ' img').css({top: '50%', left: '50%', marginLeft: Math.floor(0 - (fileWidth / 2)) + 'px', marginTop: Math.floor(0 - (fileHeight / 2)) + 'px', width: fileWidth + 'px', height: fileHeight + 'px'});
} else {
$('#case-study-image-container-' + i + ' img').css({top: '', left: '', marginLeft: '', marginTop: '', width: '', height: ''});
var k = Math.floor($('#case-study-image-container-' + i).height() - ii) / fileHeight * 100;
var l = fileWidth / 100 * k;
if (l > Math.floor($('#case-study-image-container-' + i).width() - ii)) {
$('#case-study-image-container-' + i + ' img').css({width: Math.floor($('#case-study-image-container-' + i).width() - ii) + 'px', height: ''});
var m = $('#case-study-image-container-' + i + ' img').width() / fileWidth * 100;
m = fileHeight / 100 * m; 
$('#case-study-image-container-' + i + ' img').css({top: Math.floor(($('#case-study-image-container-' + i).height() - m) / 2) + 'px', left: Math.floor(ii / 2) + 'px'});
} else {
$('#case-study-image-container-' + i + ' img').css({height: Math.floor($('#case-study-image-container-' + i).height() - ii) + 'px', width: ''});
m = $('#case-study-image-container-' + i + ' img').height() / fileHeight * 100;
m = fileWidth / 100 * m;
$('#case-study-image-container-' + i + ' img').css({left: Math.floor(($('#case-study-image-container-' + i).width() - m) / 2) + 'px', top: Math.floor(ii / 2) + 'px'});
}
}
}

function resizeCaseStudyImageLeft(i) {
var fileWidth = window['caseStudyImage' + i + 'Width'];
var fileHeight = window['caseStudyImage' + i + 'Height'];
if ($(window).width() < 960 || fileWidth >= fileHeight) {
var ii = 20;
$('#case-study-image-container-' + i + ' img').css({top: ii + 'px', left: ii + 'px', height: Math.floor(($('#case-study-image-container-' + i).height() - (ii * 3)) / 2) + 'px'});
var j = Math.floor($(window).width() - (ii * 2));
$('#case-study-image-container-' + i + ' .case-study-text-container').css({width: j + 'px', height: Math.floor($('#case-study-image-container-' + i + ' img').height()) + 'px', padding: ii + 'px', paddingTop: Math.floor($('#case-study-image-container-' + i + ' img').height() + (ii * 2)) + 'px', verticalAlign: 'top'});
} else {
ii = 40;
$('#case-study-image-container-' + i + ' img').css({top: ii + 'px', left: ii + 'px', height: Math.floor($('#case-study-image-container-' + i).height() - (ii * 2)) + 'px'});
var j = Math.floor($(window).width() - $('#case-study-image-container-' + i + ' img').width() - (ii * 3));
$('#case-study-image-container-' + i + ' .case-study-text-container').css({width: j + 'px', height: Math.floor($('#case-study-image-container-' + i + ' img').height() - ii) + 'px', padding: ii + 'px', paddingLeft: Math.floor($('#case-study-image-container-' + i + ' img').width() + (ii * 2)) + 'px', paddingBottom: Math.floor(ii * 2) + 'px', verticalAlign: ''});
}
}