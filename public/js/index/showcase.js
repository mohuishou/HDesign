$(document).ready(function() {
// Global variables
caseStudyCount = 0;
caseStudiesWidth = 0;
mobileSubNavActive = false;
// Mouse events
$(document).keydown(function(e) {
// alert(e.keyCode)
if (e.keyCode == 39) {
scrollCaseStudies();
} 
});
// Set-up
$(window).resize(function() {
calcReplacementShowcase();
toggleResponsiveItemsShowcase();
});
calcReplacementShowcase();
toggleResponsiveItemsShowcase();
$('#sub-nav').stop()
.velocity({marginTop: '0'}, 500);
$('a#sub-nav-case-studies').css({color: '#33F'});
// Mobile set-up
if (touchScreen) {

}
});

function calcReplacementShowcase() {
if (! Modernizr.csscalc) {
$('#showcase-case-studies').css({height: '100%'}).css({height: '-=83px'});
}
}

function toggleResponsiveItemsShowcase() {
if ($(window).width() < 960) {
$('#sub-nav a').css({display: 'none', width: '100%', backgroundColor: '#FFF', marginLeft: '0', marginRight: '0', marginTop: '0', paddingBottom: '15px'});
$('a#sub-nav-mobile').css({display: 'block', marginTop: '15px'});
mobileSubNavActive = false;
} else {
$('#sub-nav a').css({display: '', width: '', backgroundColor: '', marginLeft: '', marginRight: '', marginTop: '', paddingBottom: ''});
$('a#sub-nav-mobile').hide();
}
$('#showcase-case-studies a img').css({height: Math.floor($(window).height() - 183) + 'px'});
var ii = 0;
$('#showcase-case-studies a').each(function(i) {
if ($(this).is(':visible') == true) {
$('.showcase-case-study-title', this).css({width: $('img', this).width() + 'px'});
ii = ii + $(this).width() + 2;
}
});
setCaseStudiesWidth(ii);
}

function loadCaseStudy(i) {
var j = $('#showcase-case-study-' + i + ' img').attr('alt');
$('#showcase-case-study-' + i + ' img').attr({src: j})
.imagesLoaded(function() {
$(this).unbind('load')
.css({height: Math.floor($(window).height() - 183) + 'px'});
$('#showcase-case-study-' + i).show();
$('#showcase-case-study-' + i + ' .showcase-case-study-title').css({width: $(this).width() + 'px'});
var ii = caseStudiesWidth + $(this).width() + 2;
setCaseStudiesWidth(ii);
if (i == 1) {
$('a#showcase-case-studies-arrow').stop()
.velocity({right: '0'}, 500);
}
setTimeout(function() {
$('#showcase-case-study-' + i).addClass('animate-fade-in-1')
.css({opacity: 1});
if (i < caseStudyCount) {
var k = i + 1;
loadCaseStudy(k);
}
}, 100);
});
}

function setCaseStudiesWidth(i) {
$('#showcase-case-studies').css({width: i + 'px'});
caseStudiesWidth = i;
}

function scrollCaseStudies() {
var i = $('#showcase-case-studies-container').width();
var j = $('#showcase-case-studies-container').scrollLeft();
i = i + j;
$('#showcase-case-studies-container').stop()
.animate({scrollLeft: i}, 1000);
}

function showMobileSubNavShowcase() {
if (mobileSubNavActive) {
$('#sub-nav a').hide();
$('a#sub-nav-mobile').show();
mobileSubNavActive = false;
} else {
$('#sub-nav a').css({display: 'block'});
$('a#sub-nav-case-studies').hide();
mobileSubNavActive = true;
}
}